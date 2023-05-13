export default function passwordValidation() {

    // seleciona os campos de senha e de confirmação de senha
    const passwordInput = document.getElementById('senha');
    const confirmPasswordInput = document.getElementById('confirmar-senha');
    
    confirmPasswordInput.addEventListener('input', function(e) {
      // obtém o valor atual do campo de senha
      const passwordValue = passwordInput.value;
      // obtém o valor atual do campo de confirmação de senha
      const confirmPasswordValue = e.target.value;
    
      // verifica se a senha e a confirmação de senha são iguais
      if (passwordValue === confirmPasswordValue) {
        // remove a borda vermelha, se existir
        confirmPasswordInput.style.borderColor = '';
      } else {
        // adiciona a borda vermelha
        confirmPasswordInput.style.borderColor = '#F00';
      }
    });
    
    // // função para validar a senha
    // function validatePassword() {
    //   const passwordValue = passwordInput.value;
    
    //   // verifica se a senha tem pelo menos 8 caracteres
    //   if (passwordValue.length < 8) {
    //     alert('A senha deve ter pelo menos 8 caracteres');
    //     return false;
    //   }
    
    //   // verifica se a senha contém pelo menos uma letra maiúscula
    //   if (!/[A-Z]/.test(passwordValue)) {
    //     alert('A senha deve conter pelo menos uma letra maiúscula');
    //     return false;
    //   }
    
    //   // verifica se a senha contém pelo menos uma letra minúscula
    //   if (!/[a-z]/.test(passwordValue)) {
    //     alert('A senha deve conter pelo menos uma letra minúscula');
    //     return false;
    //   }
    
    //   // verifica se a senha contém pelo menos um número
    //   if (!/\d/.test(passwordValue)) {
    //     alert('A senha deve conter pelo menos um número');
    //     return false;
    //   }
    
    //   // verifica se a senha contém pelo menos um caractere especial
    //   if (!/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(passwordValue)) {
    //     alert('A senha deve conter pelo menos um caractere especial');
    //     return false;
    //   }
    
    //   return true;
    // }

    // validatePassword()
}