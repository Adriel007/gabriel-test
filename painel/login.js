// Self Invokation Function to previne users manipulation
(function () {
    const form = {
        email: document.getElementById('email'),
        password: document.getElementById('password'),
        submit: document.getElementById('submit')
    };

    form.submit.onclick = () => {
        if (!form.email.value || !form.password.value) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Preencha todos os campos!'
            });
            return;
        }

        fetch('login.php', {
            method: 'POST',
            body: JSON.stringify({
                email: form.email.value,
                password: form.password.value
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Logado com sucesso!',
                    });
                    setTimeout(() => {
                        window.location.href = 'painel.html';
                    }, 2000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.failure
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo deu errado!'
                });
                console.error(error);
            })
    }
})();