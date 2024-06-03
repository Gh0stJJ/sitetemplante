document.addEventListener("DOMContentLoaded", function() {
    console.log("AJAX init");
    const form = document.querySelector("form");
    const inputName = document.getElementById("name");
    const inputId = document.getElementById("country-id");
    
    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del formulario
        
        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./business/ctrl_countries.php", true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Actualiza la tabla con la nueva lista de países
                fetchCountries();
                // Limpia el campo de entrada
                form.reset();
                inputId.value = "";
            } else {
                console.error("Error al agregar/editar el país.");
                console.error(xhr.responseText);
            }
        };
        xhr.send(formData);
    });

    function deleteCountry(id) {
        const xhr = new XMLHttpRequest();
        xhr.open("DELETE", "./business/ctrl_countries.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status === 200) {
                fetchCountries();
            } else {
                console.error("Error al eliminar el país.");
                console.error(xhr.responseText);
            }
        };
        xhr.send(`id=${id}`);
    }

    function editCountry(id) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `./business/fetch_countries.php?id=${id}`, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const country = JSON.parse(xhr.responseText);
                    inputName.value = country.name;
                    inputId.value = country.id;
                } catch (e) {
                    console.error("Error parsing JSON: ", e);
                    console.error(xhr.responseText);
                }
            } else {
                console.error("Error al editar el país.");
                console.error(xhr.responseText);
            }
        };
        xhr.send();
    }

    function fetchCountries() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "./business/fetch_countries.php", true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const countries = JSON.parse(xhr.responseText);
                    
                    const tbody = document.querySelector("tbody");
                    tbody.innerHTML = "";
                    countries.forEach(function(country) {
                        const tr = document.createElement("tr");
                        const tdId = document.createElement("td");
                        const tdName = document.createElement("td");
                        const tdActions = document.createElement("td");
                        
                        tdId.textContent = country.id;
                        tdName.textContent = country.name;

                        const btnEdit = document.createElement("button");
                        btnEdit.textContent = "Edit";
                        btnEdit.className = "btn btn-warning btn-sm me-2";
                        btnEdit.onclick = function() {
                            editCountry(country.id);
                        };

                        const btnDelete = document.createElement("button");
                        btnDelete.textContent = "Delete";
                        btnDelete.className = "btn btn-danger btn-sm";
                        btnDelete.onclick = function() {
                            deleteCountry(country.id);
                        };

                        tdActions.appendChild(btnEdit);
                        tdActions.appendChild(btnDelete);

                        tr.appendChild(tdId);
                        tr.appendChild(tdName);
                        tr.appendChild(tdActions);
                        tbody.appendChild(tr);
                    });
                } catch (e) {
                    console.error("Error parsing JSON: ", e);
                    console.error(xhr.responseText);
                }
            } else {
                console.error("Error al obtener la lista de países.");
                console.error(xhr.responseText);
            }
        };
        xhr.send();
    }

    // Llamada inicial para llenar la tabla
    fetchCountries();
});
