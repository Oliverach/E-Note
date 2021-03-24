function displayStatus(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const className = urlParams.get('name')
    var elementClass = document.getElementsByClassName(className);
    if (elementClass.style.backgroundColor  === "#041955") {
        elementClass.style.backgroundColor = "#283E7A";
    } else {
        elementClass.style.display = "transparent";
    }

}