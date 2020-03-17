<?php
require_once 'func/functions.php';

if (!empty($_GET['query'])) {
    $query = trim($_GET['query']);
    $verifquery = substr("$query", 0, 7);

    if ($verifquery == "SELECT " || $verifquery == "select ") {
        try {
            $sqlExecute = sqlExecute($query);
            //var_dump($sqlResult);
        } catch (Exception $e) {
            $error = "Error in your query !";
        }
    } else {
        $error = "Error in your query !";
    }

} else {
    header("Location: sqlQuery.php");
}
?>
<?php require_once 'inc/header.php'; ?>
    <main role="main">
        <div class="container">
            <a class="contbtn" href="sqlQuery.php">Back to Sql Query</a><br><br>
            <p></p>
            <table align="center">
                <tr>
                    <td><h4 class="text-center" title="Structured Query Language">Sql Result</h4></td>
                    <td width="5"></td>
                    <td><a href="" title="SQL is a standardized computer language for operating relational databases. "><img
                                    src="img/quest.png" height="10" width="8"></a></td>
                </tr>
            </table>
            <p></p>
            <p><?php if (isset($error)) {
                    echo $error;
                } ?></p>
            <h5 title="Table name"><?php
                $getTable = $sqlExecute->getColumnMeta(0);
                echo $getTable['table']; ?></h5><br>

            <div class="table-responsive">
                <table class="table text-center table-bordered table-sm">
                    <thead class="geonav">
                    <tr>
                        <?php
                        $getColumnsNb = $sqlExecute->columnCount();
                        for ($i = 0; $i < $getColumnsNb; $i++) {
                            $getMeta = $sqlExecute->getColumnMeta($i);
                            $columns[] = $getMeta['name'];
                        }
                        foreach ($columns as $columName):
                            ?>
                            <th><?php echo $columName; ?></th>
                        <?php endforeach; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $getData = $sqlExecute->fetchAll();
                    foreach ($getData as $key => $data): ?>
                        <tr>
                            <?php foreach ($getData[$key] as $ind => $data): ?>
                                <td><?php echo $data; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </main>
<?php require_once 'inc/footer.php'; ?>