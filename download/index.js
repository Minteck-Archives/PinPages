// var input = document.getElementById("searchbar");

if (document.getElementById("searchbar")) document.getElementById("searchbar").addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      document.getElementById("sbsubmit").click();
    }
  }); 
  
  function handleSearch() {
      if (document.getElementById("searchbar").value.trim() == "") {} else {
        location.href = "/search/?q=" + document.getElementById("searchbar").value.trim()
      }
  }
  
  function logout() {
        location.href = "/logout/?lang=" + langprop
  }

if (client.compatibility.desktopClient()) {
  document.getElementById('loader').classList.add('hide')
  document.getElementById('dl_windows').classList.remove('hide')
} else if (client.compatibility.mobileClient()) {
  document.getElementById('loader').classList.add('hide')
  document.getElementById('dl_android').classList.remove('hide')
} else {
  document.getElementById('loader').classList.add('hide')
  document.getElementById('dl_uncompatible').classList.remove('hide')
}

function downloadWindows() {
  
}

function downloadAndroid() {

}