<?php

/**
 * Please note: we can use unencoded characters like ö, é etc here as we use the html5 doctype with utf8 encoding
 * in the application's header (in views/_header.php). To add new languages simply copy this file,
 * and create a language switch in your root files.
 */

// login & registration classes
define("MESSAGE_ACCOUNT_NOT_ACTIVATED", "Sua conta ainda não está ativada. Por favor clique o link de confirmação no seu email.");
define("MESSAGE_CAPTCHA_WRONG", "Captcha está errado!");
define("MESSAGE_COOKIE_INVALID", "Cookie inválido");
define("MESSAGE_DATABASE_ERROR", "Problem de conexão com o banco de dados.");
define("MESSAGE_EMAIL_ALREADY_EXISTS", "Este endereço de email já está registrado. Por favor use a página de \"Esqueci minha senha\" se você não se lembra dela.");
define("MESSAGE_EMAIL_CHANGE_FAILED", "Desculpe, sua mudança de email falhou.");
define("MESSAGE_EMAIL_CHANGED_SUCCESSFULLY", "O seu endereço de email foi modificado com sucesso. O novo email é ");
define("MESSAGE_EMAIL_EMPTY", "Email não pode estar vazio");
define("MESSAGE_EMAIL_INVALID", "O seu email não está em um formato válido");
define("MESSAGE_EMAIL_SAME_LIKE_OLD_ONE", "Desculpe, este endereço de email é igual ao atual. Por favor escolha outro.");
define("MESSAGE_EMAIL_TOO_LONG", "O email não pode ter mais de 254 caracteres");
define("MESSAGE_LINK_PARAMETER_EMPTY", "Dados de parâmetros de link vazios.");
define("MESSAGE_LOGGED_OUT", "Você foi desconectado da sua conta.");
// The "login failed"-message is a security improved feedback that doesn't show a potential attacker if the user exists or not
define("MESSAGE_LOGIN_FAILED", "Login falhou.");
define("MESSAGE_OLD_PASSWORD_WRONG", "Sua senha ANTIGA estava errada.");
define("MESSAGE_PASSWORD_BAD_CONFIRM", "A senha e a repetição de senha não coincidem");
define("MESSAGE_PASSWORD_CHANGE_FAILED", "Desculpe, sua mudança de senha falhou.");
define("MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY", "Senha salva com sucesso!");
define("MESSAGE_PASSWORD_EMPTY", "O campo de senha estava vazio");
define("MESSAGE_PASSWORD_RESET_MAIL_FAILED", "email de reconfiguração da senha NÃO enviado com sucesso. Erro: ");
define("MESSAGE_PASSWORD_RESET_MAIL_SUCCESSFULLY_SENT", "Email de reconfiguração de senha enviado com sucesso!");
define("MESSAGE_PASSWORD_TOO_SHORT", "O tamanho mínimo da senha é de 6 caracteres");
define("MESSAGE_PASSWORD_WRONG", "Senha errada. Tente novamente.");
define("MESSAGE_PASSWORD_WRONG_3_TIMES", "Você já inseriu uma senha incorreta 3 ou mais vezes. Por favor espere 30 segundos e tente novamente.");
define("MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL", "Desculpe, não achei esta combinação de id e código de verificação...");
define("MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL", "Ativação bem sucedida! Você pode agora logar!");
define("MESSAGE_REGISTRATION_FAILED", "Desculpe, seu registro falhou. Por favor tente novamente.");
define("MESSAGE_RESET_LINK_HAS_EXPIRED", "O seu link de reconfiguração expirou. Por favor use o link dentro de no máximo uma hora..");
define("MESSAGE_VERIFICATION_MAIL_ERROR", "Desculpe, não conseguimos te enviar um email de verificação. Sua conta NÃO foi criada.");
define("MESSAGE_VERIFICATION_MAIL_NOT_SENT", "Email de verificação NÃO foi enviado com sucesso! Erro: ");
define("MESSAGE_VERIFICATION_MAIL_SENT", "Sua conta foi criada com sucesso e te enviamos um email. Por favor clique no LINK DE VERIFICAÇÃO dentro do email.");
define("MESSAGE_USER_DOES_NOT_EXIST", "Este usuário não existe");
define("MESSAGE_USERNAME_BAD_LENGTH", "O nome de usuário não pode ter menos que 2 ou mais que 64 caracteres");
define("MESSAGE_USERNAME_CHANGE_FAILED", "Desculpe, sua mudança de nome de usuário escolhida falhou");
define("MESSAGE_USERNAME_CHANGED_SUCCESSFULLY", "Seu nome de usuário foi modificado com sucesso. O novo nome é ");
define("MESSAGE_USERNAME_EMPTY", "Campo de nome de usuário vazio");
define("MESSAGE_USERNAME_EXISTS", "Desculpe, este nome de usuário já foi usado. Por favor escolha outro.");
define("MESSAGE_USERNAME_INVALID", "O nome de usuário não está em um formato válido: apenas a-Z e números são permitidos, de 2 a 64 caracteres");
define("MESSAGE_USERNAME_SAME_LIKE_OLD_ONE", "Desculpe, este nome de usuário é o mesmo do atual. Por favor escolha outro.");

// views
define("WORDING_BACK_TO_LOGIN", "De volta a página de Login");
define("WORDING_CHANGE_EMAIL", "Mudar email");
define("WORDING_CHANGE_PASSWORD", "Mudar senha");
define("WORDING_CHANGE_USERNAME", "Mudar nome de usuário");
define("WORDING_CURRENTLY", "atualmente");
define("WORDING_EDIT_USER_DATA", "Editar dados de usuário");
define("WORDING_EDIT_YOUR_CREDENTIALS", "Você está logado e pode editar suas credenciais aqui");
define("WORDING_FORGOT_MY_PASSWORD", "Eu esqueci minha senha");
define("WORDING_LOGIN", "Entrar");
define("WORDING_LOGOUT", "Sair");
define("WORDING_NEW_EMAIL", "Novo email");
define("WORDING_NEW_PASSWORD", "Nova senha");
define("WORDING_NEW_PASSWORD_REPEAT", "Repetir nova senha");
define("WORDING_NEW_USERNAME", "Novo nome de usuário (não pode estar vazio e precisa ser azAZ09 e de 2 a 64 caracteres)");
define("WORDING_OLD_PASSWORD", "Sua senha ANTIGA");
define("WORDING_PASSWORD", "Senha");
define("WORDING_PROFILE_PICTURE", "Sua foto de perfil (direto do gravatar):");
define("WORDING_REGISTER", "Registrar");
define("WORDING_REGISTER_NEW_ACCOUNT", "Registrar nova senha");
define("WORDING_REGISTRATION_CAPTCHA", "Por favor digite estes caracteres");
define("WORDING_REGISTRATION_EMAIL", "Email de usuário (por favor forneça um endereço real, você vai receber um email de verificação com um link de ativação)");
define("WORDING_REGISTRATION_PASSWORD", "Senha (min. 6 caracteres!)");
define("WORDING_REGISTRATION_PASSWORD_REPEAT", "Repetir senha");
define("WORDING_REGISTRATION_USERNAME", "Nome de usuário (apenas letras e números, de 2 a 64 caracteres)");
define("WORDING_REMEMBER_ME", "Me mantenha logado");
define("WORDING_REQUEST_PASSWORD_RESET", "Pedir reconfiguração de senha.<br/>Entre com seu nome de usuário ou email, e você vai receber um email com instruções:");
define("WORDING_RESET_PASSWORD", "Reconfigurar minha senha");
define("WORDING_SUBMIT_NEW_PASSWORD", "Entrar com nova senha");
define("WORDING_USERNAME", "Nome de usuário");
define("WORDING_YOU_ARE_LOGGED_IN_AS", "Você está logado como ");
