let links = document.querySelectorAll(".nav a");
let content = document.querySelector(".content");
let dashboard = document.querySelector("#dash");
let parentBtn = document.querySelector("#parentBtn");
let childBtn = document.querySelector(".btn1");

parentBtn.addEventListener("mouseover", ()=>{

  childBtn.textContent = "Logout";
})

let firstLetter;
let sessionUrl = "session.php";
fetch(sessionUrl)
.then(response => response.json())
.then((data)=>{
  if(data.email)
  {
    firstLetter = data.email[0].toUpperCase();
    childBtn.textContent = firstLetter;
  }
  else
  {
    console.error("Error fetching session data");
  }
})
.catch((err)=>{
  console.error(err);
})

parentBtn.addEventListener("mouseout", () => {
  childBtn.textContent = firstLetter;
});

document.addEventListener("DOMContentLoaded", callDash);
dashboard.addEventListener("click", callDash);

function callDash()
{
  let url = "adminPages/dash.php";
    fetch(url)
    .then((res)=>{
      if(!res.ok)
      {
        console.error("Page does not exists");
      }
      else
      {
        return res.text();
      }
    })
    .then((html)=>{
      content.innerHTML=html;
    })
    .catch((err)=>{
      console.error(err);
    })
}

links.forEach(link=>{
  link.addEventListener("click", function(e){
    e.preventDefault();
    let url = this.getAttribute('href');
    fetch(url)
    .then((res)=>{
      if(!res.ok)
      {
        console.error("Page does not exists");
      }
      else
      {
        return res.text();
      }
    })
    .then((html)=>{
      content.innerHTML=html;
    })
    .catch((err)=>{
      console.error(err);
    })
  })
})

document.addEventListener('submit', function(e) {
  if (e.target && e.target.id === 'faram') {
    e.preventDefault();
    let message = document.querySelector(".msg");
    let formData = new FormData(e.target);
    fetch('adminPages/create.php', {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
    .then(res => {
      if(res=="Success")
      {
        message.textContent = "Video uploaded successfully.";
        message.style.border = "1px solid #588157";
        message.style.color = "#588157";
        e.target.reset();
      }
      else
      {
        message.textContent = res;
        message.style.border = "1px solid #9e2a2b";
        message.style.color = "#9e2a2b";
      }
      setTimeout(()=>{
        message.textContent = "";
        message.style.border = "";
        message.style.color = "";
      }, 3000)
    })
    .catch(error => {
      console.error('There was a problem with your fetch operation:', error); 
    });
  }
  else if(e.target.getAttribute('id') === 'editForm')
  {
    e.preventDefault();
    let formData = new FormData(e.target);
    let message = document.querySelector(".msg");
    fetch('adminPages/updateData.php', {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
    .then(res => {
      if(res=="Success")
      {
        message.textContent = "Content Updated successfully.";
        message.style.border = "1px solid #588157";
        message.style.color = "#588157";
        e.target.reset();
      }
      else
      {
        message.textContent = res;
        message.style.border = "1px solid #9e2a2b";
        message.style.color = "#9e2a2b";
      }
      setTimeout(()=>{
        message.textContent = "";
        message.style.border = "";
        message.style.color = "";
      }, 3000)
    })
    .catch(error => {
      console.error('There was a problem with your fetch operation:', error); 
    });
  }
});

function logout()
{
  window.location.href = "sessionDestroyer.php";
}

document.addEventListener('DOMContentLoaded', function () {
  content.addEventListener('click', function (event) {
    const clickedElement = event.target;

    if (clickedElement.classList.contains('edit')) {
      const row = clickedElement.closest('tr');
      const rowId = row.querySelector('.hidden').textContent;
      const title = row.cells[1].textContent;
      const description = row.cells[2].textContent;
      const date = row.cells[3].textContent;
      fetch("adminPages/updateData.html")
      .then((res)=>{
        if(!res.ok)
        {
          console.error("Response not okay");
        }
        else
        {
          return res.text();
        }
      })
      .then((html)=>{
        content.innerHTML = html;
        let form = content.querySelector('#editForm');

        form.querySelector("#id").value = rowId;
        form.querySelector('#editTitle').value = title;
        form.querySelector('#editDescription').value = description;

        content.innerHTML = '';
        content.appendChild(form);
      })
      .catch((e)=>{
        console.error("Error fetching data from updateData", e);
      })
    }
    else if (clickedElement.classList.contains('delete')) {
      const row = clickedElement.closest('tr');
      const rowId = row.querySelector('.hidden').textContent;

      if (confirm("Are you sure you want to proceed?")) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", 'adminPages/deleteData.php', true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onload = () => {
          if(xhr.status===200)
          {
            if(xhr.responseText === "Success")
            {
              row.remove();
            }
            else
            {
              console.error(xhr.responseText);
            }
          }
          else
          {
            console.log("Error Status: ", xhr.status);
          }
        }
        let myData = { id: rowId };
        let data = JSON.stringify(myData);

        xhr.send(data);
      //   fetch("adminPages/deleteData.php", {
      //     method: 'POST',
      //     headers: {
      //       'Content-Type': 'application/json'
      //     },
      //     data: JSON.stringify(dataToSend)
      //   })
      //   .then((res) => {
      //     if (!res.ok) {
      //       throw new Error("Network response was not ok.");
      //     }
      //     return res.text();
      //   })
      //   .then((res) => {
      //     if (res === "Success") {
      //       console.log("Deleted successfully.");
      //     } else {
      //       console.error(res);
      //     }
      //   })
      //   .catch((error) => {
      //     console.error("Error during fetch:", error);
      //   });
      }
    }    
  });
});




