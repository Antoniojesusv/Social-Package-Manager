const inputFile = window.document.getElementById('importFile');
    inputFile.addEventListener('change', function (event) {
        const inputFileLabel = window.document.getElementById('importFileLabel');
        inputFileLabel.innerHTML = inputFile.files[0].name;
    }, false);
