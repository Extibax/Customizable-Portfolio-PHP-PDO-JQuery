# Portfolio-Web-EAM
This is a Customizable Portfolio

## Description
Este portafolio esta hecho para clientes que desean una pagina web la cual puedan modificar los texto e imagenes del contenido cuando quieran, Sin tener que acceder al Source Code del proyecto, El administrador de esta pagina podra acceder a las funciones que permiten editar el contenido al iniciar sesion con la cuenta y contraseña creada por el Developer(Me), La contraseña antes de ser enviada a la Base de Datos, Es encriptada con PASSWORD_BCRYPT el cual utiliza el algoritmo CRYPT_BLOWFISH, Y las conexiones a la Base de Datos son controladas con PDO en vez de mysqli (Ya que es inseguro)

### Favorite Part
La mayoria de veces yo hago las inserciones a la base de datos expecificando para que columna va cada dato, En esta ocacion me esforze en experimentar el introducir los datos mediante __Arrays__ para centralizar todos los datos de las diferentes columnas y __Associative Arrays__ para el envio de datos en formato __JSON__, Para lograr esto hize uso de varias funciones para el control de __Arrays__ Los cuales son facinantes!, The source code is located in : __[Click here to go](php/insert_initial_content.php)__
```php
 /* Return question marks equivalent to length of array data */
  $question_marks = array_map(function () {
      return ", ?";
  }, $content);

  /* Return the question marks reduced to a single string line */
  $question_marks_reduced = ltrim(array_reduce($question_marks, function ($a, $b) {
      return $a . " " . $b;
  }), " ,");

  /* Here the single string line is added to the prepared statement */
  $stmt = $dbh->prepare("INSERT INTO content VALUES ( null, $user_id, $question_marks_reduced )");

  /* And here the array values is bind to the columns */
  array_map(function ($cont, $index) use ($stmt) {
      $stmt->bindValue($index + 1, $cont);
  }, $content, array_keys($content));

  /* After, All this is executed */
  echo $stmt->execute() ? 'Success' : 'Error: ' . $stmt->errorInfo();
```


### Lenguages, Technologies & Libraries Used
* HTML5
* CSS3
* Bootstrap 4.3.1
* FontAwesome 
* Javascript
* JQuery 3.3.1
* PHP
* PDO instead (mysqli)
* Composer
* Dotenv
* PHPMailer
* MySQL
* Quill
* AlertifyJs
* SweetAlert

### GOD BLESS
