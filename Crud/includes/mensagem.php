<?php
// Sessão
session_start();
if(isset($_SESSION['mensagem'])): ?>

    <script>
        // Mensagem
        // onload depois que toda a página foi carregada
        window.onload = function(){       
            M.toast({html: '<?php echo $_SESSION['mensagem']; ?>'})
        };
    </script>

<?php
endif;
session_unset();
?>