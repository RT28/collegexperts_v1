function onAddDocumentClick(button) {    
    var table = document.getElementById('documents-form');
    var i = table.children[0].children.length - 1;
    var row = table.insertRow();
    var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);        
                            
    cell0.innerHTML = '<input name="test-' + i + '" value=""/>';
    cell1.innerHTML = '<input name="document-' + i + '" type="file" value=""/>';   
}

function onUploadClick(e) {    
    var formData = new FormData($('#docs')[0]);
    $.ajax({
        url: 'http://localhost/yii2/collegexperts/frontend/web/index.php?r=student/upload-standard-tests',
        type: 'POST',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        success: function (data) {
            var response = JSON.parse(data);
            if (response.status == 'success') {
                alert("Update success");
                document.getElementById("modal-close").click();
            } else {
                alert("Update failed");
                console.error(response);
            }
            
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    });
    return false;    
}