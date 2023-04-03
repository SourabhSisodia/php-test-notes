const myForm = document.getElementById("myForm");
// this function prevents  default form submission
myForm.onsubmit = (e) => {
  e.preventDefault();
  const text = document.getElementById("body").value;
  let data = { title: myForm["title"].value, body: text };

  postData(data);
};

// this function  send post request to the url to add new note
async function postData(data) {
  try {
    let response = await fetch("http://local-notepad-app.com/note/add", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });
    const ans = await response.json();
    await getData();
  } catch (error) {
    console.log(error);
  }
}
// this function sends a get request and also adds the notes to the dom
async function getData() {
  try {
    let container = document.getElementById("card-container");
    container.innerHTML = "";
    const response = await fetch("http://local-notepad-app.com/note/show");
    const data = await response.json();
    console.log(data);
    data.forEach((element) => {
      let card = document.createElement("div");
      card.classList.add("card");
      let title = document.createElement("h3");
      title.innerHTML = element["title"];
      let body = document.createElement("p");
      body.innerHTML = element["body"];
      let created = document.createElement("p");
      created.innerHTML = element["created"];
      card.appendChild(title);
      card.appendChild(body);
      card.appendChild(created);
      container.appendChild(card);
    });
  } catch (error) {
    console.log(error);
  }
}
getData();
