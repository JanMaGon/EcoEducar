document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const recoveryForm = document.getElementById('recoveryForm');
    const baseUrl = "http://localhost/ecoeducar/painel";
    //const baseUrl = "https://ecoeducar.app.br/painel";

    // Função para mostrar mensagens
    const showMessage = (message, type = 'danger') => {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        // Remove alertas anteriores
        const existingAlerts = loginForm.parentElement.querySelectorAll('.alert');
        existingAlerts.forEach(alert => alert.remove());
        
        // Insere novo alerta antes do formulário
        loginForm.parentElement.insertBefore(alertDiv, loginForm);
    };

    loginForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if (!loginForm.checkValidity()) {
            e.stopPropagation();
            loginForm.classList.add('was-validated');
            return;
        }

        try {
            const formData = new FormData();
            formData.append('email', document.getElementById('email').value);
            formData.append('password', document.getElementById('password').value);
            
            const response = await fetch(baseUrl + '/validate-login', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            const result = await response.json();
            if (result.success) {
                showMessage(result.message, 'success');
                setTimeout(() => {
                    window.location.href = result.redirect;
                }, 1000);
            } else {
                showMessage(result.message);
            }
        } catch (error) {
            console.error('Erro no login:', error);
        }
    });

    recoveryForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if (!recoveryForm.checkValidity()) {
            e.stopPropagation();
            recoveryForm.classList.add('was-validated');
            return;
        }

        try {
            const formData = new FormData();
            formData.append('email', document.getElementById('recoveryEmail').value);
            
            const response = await fetch(baseUrl + '/recover-password', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            if (result.success) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('recoveryModal'));
                modal.hide();
            }
        } catch (error) {
            console.error('Erro na recuperação:', error);
        }
    });
});