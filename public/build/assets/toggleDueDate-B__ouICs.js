document.addEventListener("DOMContentLoaded",function(){const e=document.getElementById("due_date"),t=document.getElementById("no_due_date");function d(){t.checked?(e.disabled=!0,e.value=""):e.disabled=!1}t&&(t.addEventListener("change",d),d())});
