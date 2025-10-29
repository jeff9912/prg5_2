document.addEventListener('DOMContentLoaded', function () {

    const buttons = document.querySelectorAll('.filter_button')


    buttons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const url = this.href;

            fetch(url, {headers: {'X-Requested-With': 'XMLHttpRequest'}})

                .then(response => response.text())
                .then(html => {
                    // Replace the table container with new HTML
                    document.getElementById('artist_table').innerHTML = html;

                    // Highlight the selected button
                    buttons.forEach(btn => btn.classList.remove('bg-blue-500', 'text-white'));
                    this.classList.add('bg-blue-500', 'text-white');
                })
                .catch(error => console.error(error));
        });
    });
});
