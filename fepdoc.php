<?php
	/*Plugin Name: Adicionar documentos
	Plugin URI: http://marketerosweb.com
	Description: 
	Version: 0.1
	Author: oscar leguizamon
	Author URI: http://oscarleguizamon.com*/	


$dir = plugins_url().'/fepdoc/images/';
$temp = plugins_url().'/fepdoc/';
add_action("admin_menu", "oscar_agreg_menu_fep");
	
if (!function_exists("oscar_agreg_menu_fep")) 
	{
		function oscar_agreg_menu_fep()
		{
			add_menu_page("Documentos Fepcacao", "Documentos Fepcacao", "read", "df", "oscar_admin_documentos");
				add_submenu_page('df', 'Aprovar documentos', 'Aprobar documentos', 'read', 'ap', 'oscar_aprobar');
				//add_submenu_page('df', 'Borrar - Editar', 'Borrar - Editar', 'read', 'be', 'oscar_admin_grafics');
		}
	}


	function oscar_admin_documentos(){

	}


	function oscar_aprobar(){

	}

	function valrequeride($valide){
		if($valide == 1){
			echo 'required="required" style="border: 1px solid red"';
		}
		else {
			echo 'style="border: 1px solid green"';
		}

	}
	function oscar_send_docs()
	{
		if ( is_user_logged_in() ) {

			$current_user = wp_get_current_user();
			$idUSER = $current_user->ID;
			$name = $current_user->user_login;

   				echo 'Bienvenido : '.$name.'<br />'.$id;
   				global $wpdb;
   				$formAdd ='SELECT * FROM mk_documents WHERE id_user = '.$idUSER;
				$resultadosform = $wpdb->get_results($formAdd);

				if ($resultadosform)
				{
					?>
						<form action="upload" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<input type="hidden" name="idUsuario" value="<?php echo $formeditar->id_user ?>">
					<?php
					foreach ($resultadosform as $formeditar) 
					{
		   				?>
						
				        <label><?php echo $formeditar->nombreA ?></label><input type="file" name="file_array[]" <?php valrequeride($formeditar->rechazada) ?>/><br /><br />
				     	<!--<label>Archivo 2:</label><input type="file" name="file_array[]" <?php valrequeride($formeditar->val2) ?> /><br /><br />
				        <label>Archivo 3:</label><input type="file" name="file_array[]" <?php valrequeride($formeditar->val3) ?> /><br /><br />
				        <label>Archivo 4:</label><input type="file" name="file_array[]" <?php valrequeride($formeditar->val4) ?> /><br /><br />
				        <label>Archivo 5:</label><input type="file" name="file_array[]" <?php valrequeride($formeditar->val5) ?> /><br /><br />
				        <label>Archivo 6:</label><input type="file" name="file_array[]" <?php valrequeride($formeditar->val6) ?> /><br /><br />
				        <label>Archivo 7:</label><input type="file" name="file_array[]" <?php valrequeride($formeditar->val7) ?> /><br /><br />
				        <label>Archivo 8:</label><input type="file" name="file_array[]" <?php valrequeride($formeditar->val8) ?> /><br /><br />
				        <label>Archivo 9:</label><input type="file" name="file_array[]" <?php valrequeride($formeditar->val9) ?> /><br /><br />
				        <label>Archivo 10:</label><input type="file" name="file_array[]" <?php valrequeride($formeditar->val10) ?> /><br /><br />
				        <label>Archivo 11:</label><input type="file" name="file_array[]" <?php valrequeride($formeditar->val11) ?> /><br /><br />
				        <label>Archivo 12:</label><input type="file" name="file_array[]" /><br /><br />-->
				        
					<?php

					}
					?>
						<input type="submit" value="Subir documentos" />
		    		</form>
					<?php
				}
				else
				{
					?>
					nuevo
						<form action="upload" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<input type="hidden" name="idUsuario" value="<?php echo $formeditar->id_user ?>">
				        <label>Archivo 1:</label><input type="file" name="file_array[]" required="required"  /><br /><br />
				        <label>Archivo 2:</label><input type="file" name="file_array[]" required="required"/><br /><br />
				        <label>Archivo 3:</label><input type="file" name="file_array[]" required="required"/><br /><br />
				        <label>Archivo 4:</label><input type="file" name="file_array[]" required="required"/><br /><br />
				        <label>Archivo 5:</label><input type="file" name="file_array[]" required="required"/><br /><br />
				        <label>Archivo 6:</label><input type="file" name="file_array[]" required="required"/><br /><br />
				        <label>Archivo 7:</label><input type="file" name="file_array[]" required="required"/><br /><br />
				        <label>Archivo 8:</label><input type="file" name="file_array[]" required="required"/><br /><br />
				        <label>Archivo 9:</label><input type="file" name="file_array[]" required="required"/><br /><br />
				        <label>Archivo 10:</label><input type="file" name="file_array[]" required="required"/><br /><br />
				        <label>Archivo 11:</label><input type="file" name="file_array[]" required="required"/><br /><br />
				        <label>Archivo 12:</label><input type="file" name="file_array[]" required="required"/><br /><br />
				        <label>Archivo prueba:</label><input type="file" name="archivo12" required="required"/><br /><br />
				        <input type="submit" value="Subir documentos" />
		    		</form>
					<?php
				}
			}
				else {

		    echo 'Para poder adjuntar los documentos debes iniciar sesión';
				}
	}


function actionupload()
{
	$path = $temp."http://www.fepcacao.com.co/test_uploads/";
	@$idUsuario1 = $_POST['idUsuario'];
//Hacemos un poco de código verificando que se recibieron las imagenes
if(isset($_FILES['file_array'])){

    //almacenamos las propiedades de las imagenes
    $prueba = $_FILES['archivo12']['name'];
    $name_array = $_FILES['file_array']['name'];
    $tmp_name_array = $_FILES['file_array']['tmp_name'];
    $type_array = $_FILES['file_array']['type'];
    $size_array = $_FILES['file_array']['size'];
    $error_array = $_FILES['file_array']['error'];
    $archivonum = array('Archivo 1', 'Archivo 2', 'Archivo 3', 'Archivo 4', 'Archivo 5', 'Archivo 6', 'Archivo 7', 'Archivo 8', 'Archivo 9', 'Archivo 10', 'Archivo 11', 'Archivo 12' );

    $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
	$QuantidadeCaracteres = strlen($Caracteres); 
	$Posicao = rand(0,$QuantidadeCaracteres); 
    //recorremos el array de imagenes para subirlas al simultaneo
    global $wpdb;
    $sql1 = "INSERT INTO mk_documents (id_user, nombreA, archivo12) VALUES ($idUsuario1, '$prueba')";
            //mysqli_query($server,"INSERT INTO mk_documents (archivo1) VALUES ('$idUsuario1.$Posicao.$name_array[$i]')");
            $wpdb->query($sql1);

    for($i = 0; $i < count($tmp_name_array); $i++){
        if(move_uploaded_file($tmp_name_array[$i], "test_uploads/".$idUsuario1.$Posicao.$name_array[$i])){

            //guardamos en la base de datos el nombre
        	$sql = "INSERT INTO mk_documents (id_user, nombreA, archivo1) VALUES ($idUsuario1,'$archivonum[$i]', '$idUsuario1.$Posicao.$name_array[$i]')";
            //mysqli_query($server,"INSERT INTO mk_documents (archivo1) VALUES ('$idUsuario1.$Posicao.$name_array[$i]')");
            $wpdb->query($sql);
            //mostramos las imagenes para verificar que se subieron :)
            echo "<img src='".$path.$idUsuario1.$Posicao.$name_array[$i]."'> <br />Se ha subido exitosamente<br />";
        }
        else
        {
            //si ocurrio algun problema entonces
            echo "move_uploaded_file function failed for ".$name_array[$i]."<br>";
        }
    }
}

}

function actionupdate()
{
	$path = $temp."http://www.fepcacao.com.co/test_uploads/";
	@$idUsuario1 = $_POST['idUsuario'];
//Hacemos un poco de código verificando que se recibieron las imagenes
if(isset($_FILES['file_array'])){

    //almacenamos las propiedades de las imagenes
    $prueba = $_FILES['archivo12']['name'];
    $name_array = $_FILES['file_array']['name'];
    $tmp_name_array = $_FILES['file_array']['tmp_name'];
    $type_array = $_FILES['file_array']['type'];
    $size_array = $_FILES['file_array']['size'];
    $error_array = $_FILES['file_array']['error'];
    $archivonum = array('Archivo 1', 'Archivo 2', 'Archivo 3', 'Archivo 4', 'Archivo 5', 'Archivo 6', 'Archivo 7', 'Archivo 8', 'Archivo 9', 'Archivo 10', 'Archivo 11', 'Archivo 12' );

    $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
	$QuantidadeCaracteres = strlen($Caracteres); 
	$Posicao = rand(0,$QuantidadeCaracteres); 
    //recorremos el array de imagenes para subirlas al simultaneo
    global $wpdb;
    $sql1 = "INSERT INTO mk_documents (id_user, nombreA, archivo12) VALUES ($idUsuario1, '$prueba')";
            //mysqli_query($server,"INSERT INTO mk_documents (archivo1) VALUES ('$idUsuario1.$Posicao.$name_array[$i]')");
            $wpdb->query($sql1);

    for($i = 0; $i < count($tmp_name_array); $i++){
        if(move_uploaded_file($tmp_name_array[$i], "test_uploads/".$idUsuario1.$Posicao.$name_array[$i])){

            //guardamos en la base de datos el nombre
        	$sql = "UPDATE  mk_documents (id_user, nombreA, archivo1) VALUES ($idUsuario1,'$archivonum[$i]', '$idUsuario1.$Posicao.$name_array[$i]')";
            //mysqli_query($server,"INSERT INTO mk_documents (archivo1) VALUES ('$idUsuario1.$Posicao.$name_array[$i]')");
            $wpdb->query($sql);
            //mostramos las imagenes para verificar que se subieron :)
            echo "<img src='".$path.$idUsuario1.$Posicao.$name_array[$i]."'> <br />Se ha subido exitosamente<br />";
        }
        else
        {
            //si ocurrio algun problema entonces
            echo "move_uploaded_file function failed for ".$name_array[$i]."<br>";
        }
    }
}

}
add_shortcode('update','actionupdate');
add_shortcode('sendocs', 'oscar_send_docs');
add_shortcode('actionupload', 'actionupload');
