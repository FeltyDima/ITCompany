$(document).ready(function () {
    $('#contactForm').submit(function (e) {
        e.preventDefault();
        $.post('ajax.php', $(this).serialize(), function (response) {
            if (response.success) {
                $('#successModal').modal('show');
            } else {
                $('#errorModal').modal('show');
            }
        }, 'json').fail(() => $('#errorModal').modal('show'));
    });

    $('#refreshContacts').click(function () {
        console.log("Кнопка 'Обновить список' нажата!");

        $.ajax({
            url: 'ajax.php',
            method: 'GET',
            dataType: 'json',
            success: function (contacts) {
                console.log("Данные получены:", contacts);

                let list = $('#contactsList').empty();
                contacts.forEach(contact => {
                    list.append(`
                        <li class="list-group-item">
                            ${contact.full_name} - ${contact.email} (${contact.phone})
                        </li>
                    `);
                });
            },
            error: function (xhr, status, error) {
                console.error("Ошибка при запросе:", error);
            }
        });
    });
});