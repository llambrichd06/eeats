const logReloadButton = document.getElementById('logReload');

logReloadButton.addEventListener('click', () => {
    showLogs();
});

showLogs();

//MAIN FUNCTION TO FETCH AND SHOW LOGS

async function showLogs() {
    fetch(currentApiURL+"?controller=Log&action=getLogs", {
        method: 'GET'
    }).then(r => r.json())
    .then(r => {
        const tbody = document.getElementById('logTableBody');
        tbody.innerHTML = "";
        r.forEach(log => {
            const newLog = new Log(log.id, log.user_id, log.log_date, log.action);
            const logRow = document.createElement('tr');

            Object.entries(newLog).forEach(([key, logData]) => { 
                const block = document.createElement('td');
                block.innerHTML = logData;
                logRow.append(block);
            });

            tbody.append(logRow);
        })
    });
}

class Log {
    constructor(id, user_id, log_date, action) {
        this.id = id;
        this.user_id = user_id;
        this.log_date = log_date;
        this.action = action;
    }

    getId() { 
        return this.id;
    }
    getUserId() { 
        return this.user_id;
    }
    getLogDate() { 
        return this.log_date;
    }
    getAction() { 
        return this.action;
    }
}
