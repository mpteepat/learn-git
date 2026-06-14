// Opens a pop-up window asking for input
const userName = prompt("Please enter your name:");

// Check if the user didn't cancel the prompt
if (userName !== null) {
    console.log("Hello, " + userName);
    async function calculateOEE(machineId, date, shift) {

        // 1. Get planned time from shift schedule
        const plannedMinutes = 480; // 8 hour shift

        // 2. Calculate run time from machine_status table
        const runTime = await db.query(`
      SELECT SUM(TIMESTAMPDIFF(MINUTE, started_at, ended_at)) as minutes
      FROM machine_status
      WHERE machine_id = ? 
      AND status = 'running'
      AND DATE(started_at) = ?
    `, [machineId, date]);

        // 3. Get production counts
        const production = await db.query(`
      SELECT SUM(good_count) as good, SUM(bad_count) as bad
      FROM production_log
      WHERE machine_id = ? AND DATE(timestamp) = ?
    `, [machineId, date]);

        const runMinutes = runTime[0].minutes || 0;
        const goodParts = production[0].good || 0;
        const badParts = production[0].bad || 0;
        const totalParts = goodParts + badParts;
        const idealCycle = 0.5; // minutes per part (from machine spec)

        // 4. Calculate
        const availability = runMinutes / plannedMinutes;
        const performance = (idealCycle * totalParts) / runMinutes;
        const quality = goodParts / totalParts;
        const oee = availability * performance * quality;

        // 5. Save result to database
        await db.query(`
      INSERT INTO oee_results 
      (machine_id, date, shift, availability, performance, quality, oee,
       planned_time, run_time, total_parts, good_parts)
      VALUES (?,?,?,?,?,?,?,?,?,?,?)
    `, [machineId, date, shift,
            availability * 100, performance * 100, quality * 100, oee * 100,
            plannedMinutes, runMinutes, totalParts, goodParts
        ]);

        return { availability, performance, quality, oee };
    }
}