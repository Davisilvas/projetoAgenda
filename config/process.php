<?php 

    session_start();

    include_once("connection.php");
    include_once("url.php");

    
    $data = $_POST;

    if(!empty($data)){ #modificação de dados

        # criação de um novo contato
        if($data["type"]==="create"){
            $name = $data["name"];
            $phone = $data["phone"];
            $observations = $data["observations"];

            $query = "INSERT INTO contacts (name, phone, observations) VALUES (:name, :phone, :observations)";

            $stmt = $conn-> prepare($query);
            $stmt -> bindParam(":name",$name);
            $stmt -> bindParam(":phone",$phone);
            $stmt -> bindParam(":observations",$observations);

            try{
                $stmt -> execute();
                $_SESSION["msg"] = "Contato salvo na agenda!";

            }catch(PDOException $e){
                $error = $e->getMessage();
                echo "Erro: $error";
            }


        }elseif($data["type"]==="edit"){
            # Editando os dados de um contato
            $name = $data["name"];
            $phone = $data["phone"];
            $observations = $data["observations"];
            $id = $data["id"];

            $query = "UPDATE contacts 
                    SET name = :name, 
                    phone = :phone, 
                    observations = :observations 
                    WHERE id = :id";

            $stmt = $conn->prepare($query);

            $stmt -> bindParam(":name",$name);
            $stmt -> bindParam(":phone",$phone);
            $stmt -> bindParam(":observations",$observations);
            $stmt -> bindParam(":id",$id);
        
            try{
                $stmt -> execute();
                $_SESSION["msg"] = "Contato editado!";
    
            }catch(PDOException $e){
                $error = $e->getMessage();
                echo "Erro: $error";
            }
        }elseif($data["type"]==="delete"){
            $id = $data["id"];

            $query = "DELETE FROM contacts WHERE id = :id";

            $stmt = $conn ->prepare($query);

            $stmt-> bindParam(":id", $id);

            try{
                $stmt -> execute();
                $_SESSION["msg"] = "Contato removido da sua agenda!";
    
            }catch(PDOException $e){
                $error = $e->getMessage();
                echo "Erro: $error";
            }
        }

        // redirecionando
        header("Location:" . $BASE_URL . "../index.php");

    }else{ #seleção de dados
        $id;
    
        if(!empty($_GET)){
            $id = $_GET['id'];
        }
    
        
    
        if(!empty($id)){
            //Retorna o dado de um contato
            
            $selectOne = "SELECT * FROM contacts WHERE id = :id";
    
            $stmt = $conn->prepare($selectOne);
            
            $stmt -> bindParam(":id", $id);
    
            $stmt -> execute();
    
            $contact = $stmt -> fetch();
    
        }else{
            
            // Retorna todos os contatos
    
            $contacts = [];
    
            $selectAll = "SELECT * FROM contacts";
    
            $stmt = $conn->prepare($selectAll);
    
            $stmt -> execute();
    
            $contacts = $stmt -> fetchAll();
        }
    
    }
    
    
    $conn = null;
?>