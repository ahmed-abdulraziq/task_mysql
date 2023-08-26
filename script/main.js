$(document).ready(function () {
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Select/Deselect checkboxes
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function () {
        if (this.checked) {
            checkbox.each(function () {
                this.checked = true;
            });
        } else {
            checkbox.each(function () {
                this.checked = false;
            });
        }
    });
    checkbox.click(function () {
        if (!this.checked) {
            $("#selectAll").prop("checked", false);
        }
    });
});

function Edit(id, name, email, address, phone) {
    document.getElementById("editId").value = id;
    document.getElementById("editName").value = name;
    document.getElementById("editEmail").value = email;
    document.getElementById("editAddress").value = address;
    document.getElementById("editPhone").value = phone;
}

function Delete(id) {
    if (id) {
        document.getElementById("deleteId").value = id;
        document.querySelector('input[value="Delete"]').disabled = false;
    } else {
        let ids = "";
        let items = document.querySelectorAll("table tr td input");

        for (const i of items) {
            ids += i.checked? " " + i.value:"";
        }

        document.getElementById("deleteId").value = ids.trim();
        document.querySelector('input[value="Delete"]').disabled = ids?false:true;
    }
}

const selectAll = document.getElementById("selectAll");
selectAll.addEventListener('click', (e) => {
    let items = document.querySelectorAll("table tr td input");

    for (const i of items) {
        i.checked = e.checked;
    }
})