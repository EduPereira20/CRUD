<?php require_once 'connect.php';?>
<?php 

class DAO {
    function insertUser($insert, $conn) {
            
        if ($conn instanceof mysqli) {
            $sqlSelect = "SELECT * FROM usuarios WHERE email = ?";
            $email = $insert->getEmail(); 
    
            $stmtSelect = mysqli_prepare($conn, $sqlSelect);
            mysqli_stmt_bind_param($stmtSelect, "s", $email);
            mysqli_stmt_execute($stmtSelect);
            $result = mysqli_stmt_get_result($stmtSelect);
    
            if (mysqli_num_rows($result) > 0) {
                header("Location: ../view/error.html");
            } else {
                $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
                $nome = $insert->getNome();
                $senha = $insert->getSenha();
    
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'sss', $nome, $email, $senha);
    
                try {
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
    
                    header("Location: ../view/login.html");
                    exit;
                } catch (mysqli_sql_exception $e) {
                    echo "Fatal error: " . $e->getMessage();
                }
            }
            mysqli_stmt_close($stmtSelect);
        } else {
            echo "Invalid MySQLi connection";
        }
    }
    function logar($conn, $logar){
        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if($stmt){
            $email = $logar->getEmail();
            $senha = $logar->getSenha();

            mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($resultado) > 0){
                header("Location: ../view/index.html");
                exit;
            } else{
                 header("Location: ../view/error2.html");
            }
    }
}
function alterar($alterar, $emailAntigo, $conn) {
    $sqlSelect = "SELECT * FROM usuarios WHERE email = ?";
    $stmtSelect = mysqli_prepare($conn, $sqlSelect);

    if ($stmtSelect) {
        mysqli_stmt_bind_param($stmtSelect, "s", $emailAntigo);
        mysqli_stmt_execute($stmtSelect);
        $resultado = mysqli_stmt_get_result($stmtSelect);

        if (mysqli_num_rows($resultado) > 0) {
            $sqlUpdate = "UPDATE usuarios SET email = ?, nome = ?, senha = ? WHERE email = ?";
            $stmtUpdate = mysqli_prepare($conn, $sqlUpdate);

            if ($stmtUpdate) {
                $novoEmail = $alterar->getEmail();
                $novoNome = $alterar->getNome();
                $novaSenha = $alterar->getSenha();

                mysqli_stmt_bind_param($stmtUpdate, "ssss", $novoEmail, $novoNome, $novaSenha, $emailAntigo);

                try {
                    mysqli_stmt_execute($stmtUpdate);
                } catch (mysqli_sql_exception $e) {
                    echo "Error: " . $e->getMessage();
                }

                mysqli_stmt_close($stmtUpdate);
            }
        }

        mysqli_stmt_close($stmtSelect);
    }
}
        
    }

?>

