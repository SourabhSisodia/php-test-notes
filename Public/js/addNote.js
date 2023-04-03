const myForm = document.getElementById("myForm");

myForm.onsubmit = (e) => {
  e.preventDefault();
  const text = document.getElementById("body").value;
  let data = { title: myForm["title"].value, body: text };
  console.log(data);
  post_data(data);
};

async function post_data(data) {
  try {
    await fetch("http://local-notepad-app.com/note/addNote", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });
    await get_data();
  } catch (error) {
    console.error(error);
  }
}
async function get_data() {
  try {
    const tableBody = document.getElementById("table-body");
    tableBody.innerHTML = "";
    const response = await fetch("http://local-notepad-app.com/note/addNote");
    const data = await response.json();

    data.forEach((element) => {
      const newRow = document.createElement("tr");
      Object.keys(element).forEach((key) => {
        const nameCell = document.createElement("td");

        nameCell.textContent = element[key];
        newRow.appendChild(nameCell);
      });
      tableBody.appendChild(newRow);
    });
  } catch (error) {
    console.error(error);
  }
}
get_data();
