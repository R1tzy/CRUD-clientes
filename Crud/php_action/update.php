<?php
// Sessão
session_start();
// conexão
require_once 'db_connect.php';
// Clear
function clear($input) {
	global $connect;
	// sql
	$var = mysqli_escape_string($connect, $input);
	// xss
	$var = htmlspecialchars($var);
	return $var;
}
if(isset($_POST['btn-atualizar']))
{
    if (!$idade = filter_input(INPUT_POST,'idade',FILTER_VALIDATE_INT))
    {
        $_SESSION['mensagem'] = "Erro ao Atualizar - idade inválida";
        header('Location: ../index.php');
    }
    else
    {
        // filtrar os dados que estão sendo informados no input
        $nome = clear($_POST['nome']);
	    $sobrenome = clear($_POST['sobrenome']);
	    $email = clear($_POST['email']);
	    $idade = clear($_POST['idade']);
        $id = mysqli_escape_string($connect, $_POST['id']);

        $sql = "UPDATE clientes SET nome = '$nome', sobrenome = '$sobrenome', email='$email', idade='$idade' WHERE id='$id'";
        if(mysqli_query($connect, $sql)):
            $_SESSION['mensagem'] = "Atualizado com sucesso";
            header('Location: ../index.php');
        else:
            $_SESSION['mensagem'] = "Erro ao atualizar";
            header('Location: ../index.php?erro');
        endif;
        mysqli_close($connect);
    }
}