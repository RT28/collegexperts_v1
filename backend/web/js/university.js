function onAddRankingButtonClick(button) {
    var table = document.getElementById('institution-rankings-form');
    var i = table.children[0].children.length - 1;
    var row = table.insertRow();
    var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell2 = row.insertCell(2);        
                            
    cell0.innerHTML = '<input id="rank-' + i + '" value=""/>';
    cell1.innerHTML = '<input id="source-' + i + '" value=""/>';
    cell2.innerHTML = '<button data-index="' + i + '" class="btn btn-danger" onclick="onDeleteRankingButtonClick(this)"><span class="glyphicon glyphicon-minus"></span></button>';   
}

function onDeleteRankingButtonClick(button) {
    var index = Number(button.getAttribute('data-index'));
    var rankings = getRankings();

    //remove from array.
    rankings.splice(index, 1);    

    //update rankings
    setRankings(rankings);

    //update table DOM
    updateTableDOM(rankings, 'institution-rankings-form', true);
}

function onSaveChangesClick(button) {
    var rankings = [];
    var table = document.getElementById('institution-rankings-form');
    var rows = table.children[0].children.length;

    for(var i = 1; i < rows; i++) {
        rankings.push({
            'rank': document.getElementById('rank-' + (i - 1)).value,
            'source': document.getElementById('source-' + (i - 1)).value,
        })
    }
    setRankings(rankings);
    updateTableDOM(rankings,'institution-rankings');
    document.getElementById("modal-close").click();
}

function getRankings() {
    var str = document.getElementById('university-rankings').value;
    return JSON.parse(str);    
}

function setRankings(arr) {
    var rankings = document.getElementById('university-rankings');
    rankings.value = JSON.stringify(arr);
}

function updateTableDOM(arr, id, editable) {
    var table = document.getElementById(id);

    //remove all rows
    var i = table.children[0].children.length - 1;
    while(table.children[0].children.length != 1) {
        table.deleteRow(i--);
    }

    //add rows as per arr
    for(var i = 0; i < arr.length; i++) {
        var row = table.insertRow();                

        if (editable) {
            var cell0 = row.insertCell(0);
            var cell1 = row.insertCell(1);
            var cell2 = row.insertCell(2);
            cell0.innerHTML = '<input id="rank-' + i + '" value="' + arr[i].rank + '"/>';
            cell1.innerHTML = '<input id="source-' + i + '" value="' + arr[i].source + '"/>';
            cell2.innerHTML = '<button data-index="' + i + '" class="btn btn-danger" onclick="onDeleteRankingButtonClick(this)"><span class="glyphicon glyphicon-minus"></span></button>';
        } else {
            var cell0 = row.insertCell(0);
            var cell1 = row.insertCell(1);        
            cell0.innerHTML = arr[i].rank;
            cell1.innerHTML = arr[i].source;            
        }                  
        
    }
}