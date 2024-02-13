<?php
require 'includes/connection.php';
include 'templates/header.php';
?>

<div class="container mt-4">
    <h1 class="text-center">Bem-vindo sistema de gerenciamento de usuários e cores!</h1>
    <br>
    <h3 class="mt-4">Como usar o sistema:</h3>
    <ol>
        <li><strong>Criar Usuário:</strong></li>
        <ul>
            <li>Clique no botão <a href="/system/users/create.php">"Adicionar Usuário"</a> na página principal.</li>
            <li>Preencha o formulário com o nome e o e-mail do novo usuário.</li>
            <li>Clique em "Cadastrar" para criar o usuário.</li>
        </ul>
        <li><strong>Definir Cor para o Usuário:</strong></li>
        <ul>
            <li>Depois de criar o usuário, você pode definir uma cor para ele.</li>
            <li>Na página de lista de usuários, clique no botão "Definir Cor" ao lado do usuário desejado.</li>
            <li>Selecione uma cor na lista suspensa e clique em "Atualizar" para atribuir a cor ao usuário.</li>
        </ul>
        <li><strong>Criar ou Editar Cores:</strong></li>
        <ul>
            <li>Na página principal, clique no botão <a href="/system/colors/list.php">"Gerenciar Cores"</a> para acessar a lista de cores.</li>
            <li>Para criar uma nova cor, clique em <a href="/system/colors/create.php">"Adicionar Cor"</a>.</li>
            <li>Use a paleta de cores para selecionar a cor desejada e dê um nome para ela.</li>
            <li>Clique em "Cadastrar" para criar a cor.</li>
            <li>Para editar uma cor existente, clique em "Editar" ao lado da cor desejada.</li>
            <li>Selecione uma nova cor na paleta de cores ou altere o nome da cor.</li>
            <li>Clique em "Atualizar" para salvar as alterações.</li>
        </ul>
        <li><strong>Visualizar, Editar ou Excluir Usuário:</strong></li>
        <ul>
            <li>Na página de <a href="/system/users/list.php">"lista de usuários"</a>, você pode ver todos os usuários cadastrados.</li>
            <li>Você pode clicar em "Editar" para atualizar as informações do usuário.</li>
            <li>Clique em "Excluir" para remover o usuário do sistema.</li>
        </ul>
    </ol>
    <p><strong>Observações:</strong></p>
    <ul>
        <li>Cada usuário pode ter uma única cor associada a ele.</li>
        <li>A cor definida para cada usuário será exibida na linha correspondente.</li>
    </ul>
    <p>Espero que você aproveite o uso do sistema!</p>
</div>

<?php include 'templates/footer.php'; ?>
