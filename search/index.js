document.getElementById('searchbar').value = query

document.getElementById("searchbar").addEventListener("keyup", function(event) {
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

function requestFriend(user) {
  location.href = "/invite/?name=" + user
}

function removeFriend(user) {
  location.href = "/remove/?name=" + user
}

function viewPage(user) {
  location.href = "/page/?user=" + user
}