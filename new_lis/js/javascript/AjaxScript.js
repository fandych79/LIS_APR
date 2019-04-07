
//Global XMLHTTP Request object
var XmlHttp;
var idx;
//Creating and setting the instance of appropriate XMLHTTP Request object to a “XmlHttp” variable  
function CreateXmlHttp(){
    //Creating object of XMLHTTP in IE
    try {
        XmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    } 
    catch (e) {
        try {
            XmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        } 
        catch (oc) {
            XmlHttp = null;
        }
    }
    //Creating object of XMLHTTP in Mozilla and Safari 
    if (!XmlHttp && typeof XMLHttpRequest != "undefined") {
        XmlHttp = new XMLHttpRequest();
    }
}

//Gets called when country combo box selection changes
function CountryListOnChange(_id){
    idx = _id;
    var countryList = document.getElementById("_Vessel" + idx);
    
    //Getting the selected country from country combo box.
    var selectedCountry = countryList.options[countryList.selectedIndex].value;
    
    // URL to get states for a given country
    var requestUrl = AjaxServerPageName + "?SelectedVessel=" + encodeURIComponent(selectedCountry);
    CreateXmlHttp();
    
    // If browser supports XMLHTTPRequest object
    if (XmlHttp) {
        //Setting the event handler for the response
        XmlHttp.onreadystatechange = HandleResponse;
        
        //Initializes the request object with GET (METHOD of posting), 
        //Request URL and sets the request as asynchronous.
        XmlHttp.open("GET", requestUrl, true);
        
        //Sends the request to server
        XmlHttp.send(null);
    }
}

//Called when response comes back from server
function HandleResponse(){
    // To make sure receiving response data from server is completed
    if (XmlHttp.readyState == 4) {
        // To make sure valid response is received from the server, 200 means response received is OK
        if (XmlHttp.status == 200) {
            ClearAndSetStateListItems(XmlHttp.responseXML.documentElement);
        }
        else {
            alert("There was a problem retrieving data from the server.");
        }
    }
}

//Clears the contents of state combo box and adds the states of currently selected country
function ClearAndSetStateListItems(countryNode){
    var stateList = document.getElementById("_Voyage" + idx);
    //Clears the state combo box contents.
    for (var count = stateList.options.length - 1; count > -1; count--) {
        stateList.options[count] = null;
    }
    
    var stateNodes = countryNode.getElementsByTagName('VOYAGE_NO');
    var stateNodes2 = countryNode.getElementsByTagName('ID_VOYAGE');
    var textValue;
    var optionItem;
    //Add new states list to the state combo box.
    for (var count = 0; count < stateNodes.length; count++) {
        textValue = GetInnerText(stateNodes[count]);
        textValue2 = GetInnerText(stateNodes2[count]);
        optionItem = new Option(textValue, textValue2, false, false);
        stateList.options[stateList.length] = optionItem;
        if (count == 0) {
            var b = document.getElementById("_VoyageValue" + idx);
            b.value = textValue2;
        }
    }
}

//Returns the node text value 
function GetInnerText(node){
    return (node.textContent || node.innerText || node.text);
}









