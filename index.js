let switchMode = document.querySelector(".fa-moon");
let body = document.querySelector('body');
let toggleSwap = ()=>{
  switchMode.classList.toggle("fa-sun");
  switchMode.classList.toggle("fa-moon");
  switchMode.classList.add("animate-swap");
  body.classList.toggle('light-mode');
  setTimeout(() => {
    switchMode.classList.remove("animate-swap");
  }, 300);
}