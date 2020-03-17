<?php
require_once 'func/functions.php';

// Managing queries
if(isset($_SESSION['teacher'])){
    $session = $_SESSION['teacher'];
    $nbQueries = nbQueries($session);
    $saveQueries = recupQueries($session);
}

if(isset($_SESSION['admin'])){
    $session = $_SESSION['admin'];
    $nbQueries = nbQueries($session);
    $saveQueries = recupQueries($session);
}

if(isset($_POST['submit'])){
    $query = trim($_POST['query']);
    $verifquery = substr("$query", 0, 7);

    if($verifquery == "SELECT " || $verifquery == "select "){
        try{
            $sqlExecute = sqlExecute($query);
            if(isset($_POST['save'])){
                $alreadySave = queryAlreadySave($session, $query);
                if($alreadySave) {
                    header("Location: sqlResult.php?query=$query");
                }else{
                    saveQuery($session, $query);
                    header("Location: sqlResult.php?query=$query");
                }
            }else{
                header("Location: sqlResult.php?query=$query");
            }

        }catch (Exception $e){
            $error = "Error in your query ! ".$e->getMessage().".";
        }
    }else{
        $error = "Error in your query !";

    }
}

// Delete query
if(isset($_GET['delete'])){
    $queryID = $_GET['delete'];
    $queryExist = verifQuery($queryID,$session);
    if($queryExist){
        deleteQuery($queryID,$session);
        header("Location: sqlQuery.php");
        exit;
    }
}


?>
<?php require_once 'inc/header.php'; ?>
<main role="main">
    <div class="container">
        <table align="center">
            <tr>
                <td><h4 class="text-center" title="Structured Query Language">SQL Query</h4></td>
                <td width="5"></td>
                <td><a href="" title="SQL is a standardized computer language for operating relational databases. "><img src="img/quest.png" height="10" width="8"></a></td>
            </tr>
        </table>

        <div class="row">
            <div class="col-sm-6"><br>
                <form method="POST" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <h5>&#9888; Only select queries !</h5>
                        <p class="text-center" style="color: #dc3545;"><?php if(isset($error)){ echo $error; } ?></p>
                        <input type="text" class="form-control" name="query" placeholder="Ex : SELECT * FROM Country" i id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php if(isset($query)){ echo $query; } ?>" required="required">
                        <div class="invalid-feedback">
                            Valid query is required.
                        </div>
                    </div>
                <?php if(adminLogged() || teacherLogged()): ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="save" >Save&nbsp;
                        <a href="" title="If this request exists in the backup list it will not be saved a second time !"> <img src="img/quest.png" height="10" width="8"></a>
                    </div>
                <?php endif; ?>
                    <h4 class="text-center"><button style="margin: auto;" class="contbtn" type="submit" name="submit">Execute</button></h4>
                </form>
                <?php if(adminLogged() || teacherLogged()): ?>
                <br><p></p>
                <h6><?php if($nbQueries->nb == 1){ echo "(1) saved query"; }elseif($nbQueries->nb > 1){ echo "($nbQueries->nb) saved queries"; } ?></h6><p></p>
                    <table style="margin: auto;" class="table table-bordered">
                    <?php foreach($saveQueries as $q): ?>

                        <tr>
                            <td><a href="sqlResult.php?query=<?php echo $q->query; ?>" title="<?php echo $q->query; ?>">
                                    <?php
                                        if(strlen($q->query) > 50){
                                            echo substr("$q->query", 0, 50), "...";
                                        }else{
                                            echo $q->query;
                                        }
                                    ?>
                                </a></button></form></td>
                            <td class="text-center">
                                <a style="text-decoration: none; color: #000000; font-size: 14px; font-weight: bold;" href="sqlQuery.php?delete=<?php echo $q->id; ?>"
                               onClick="return confirm('Are you sure you want to delete this query ?')" title="Delete" >X</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                 <?php endif; ?>
            </div>

            <div class="col-sm-6 "><br>
                <div class="col-sm-12">
                    <h5 class="text-center">Database schema</h5><p></p>
                    <img src="img/dbschema.png" class="d-block w-100">
                </div>
                <br><p></p>
            </div>
        </div>
    </div>
</main>
<?php require_once 'inc/footer.php'; ?>