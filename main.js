let websiteInputForm, addButton;

//Method called when page is loaded for the first time
const initialize = () => {
  websiteInputForm = document.getElementById("websiteInputForm");
  addButton = document.getElementById("addButton");

  //Add event listeners to objects
  addButton.addEventListener("click", addWebsite, false);
};

//If add button was pressed 
const addWebsite = async () => {
  if (websiteInputForm.value.indexOf('.') < 0) { //Check if user input contains at least one dot, otherwise the web address is a priori invalid
    window.alert("Please enter valid web address!");
    websiteInputForm.value = "";
  }
  else {
    let isWebsiteValid = await checkWebsiteValidity(websiteInputForm.value);

    if (isWebsiteValid) {
      alert (`${websiteInputForm.value} is valid and added to bookmarks`);
    }
    else {
      window.alert("The entered web address is not active! Please check your input");
      websiteInputForm.value = "";
    }    
  }
};

//Method checking website validity 
const checkWebsiteValidity = async (url) => {
  try {
    const response = await fetch(`https://cors-anywhere.herokuapp.com/${url}`);

    if (response.ok) {
      console.log(response);
      return true;
    }
    else {
      return false;
    }
  }
  catch (networkError) {
    console.log(networkError);
    return false;
  }
};

window.addEventListener("load", initialize, false);