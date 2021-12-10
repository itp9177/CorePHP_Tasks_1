<?php
/*
use App\Controller\ProviderController;
$providers = ProviderController::get()->getProviders();*/
if (!isset($filters))
    $filters = NULL;
if(!isset($providers))
    $providers=NULL;


?>
<!DOCTYPE html>
<html>
<head>
    <title>Megebit task</title>

    <style><?php include __DIR__ . "/../web/css/page.css"; ?></style>
</head>
<body>
<div class="container">
    <div class=header>
        <input type="text" value="<?php if (isset($filters)) {
            echo $filters['search'];
        } ?>" id="keyword" name="search" form="myForm">
        <input type="submit" id="submit" value="search" form="myForm">
    </div>
    <div class="content">
        <div class="myfilers">
            <form method="get" name="myForm" id="myForm" action="/search">
                <?php foreach ($providers as $row => $provider) : ?>
                    <label for="fname"><?php echo $provider['Name'] ?> </label>
                    <input type="checkbox" id="fname"
                           name="filter[<?php echo $provider['Name'] ?>]" <?php if ($filters != NULL) {
                        echo(($filters['filter'][$provider['Name']]) ? 'checked' : '');
                    } ?> >
                    <br>
                <?php endforeach; ?>
                <input type="submit" id="submit" value="filter">
            </form>
        </div>

        <div class="allemails">
            <div class="sortby">
                <label for="sort">sort by</label>
                <select name="sort" id="sort" form="myForm">
                    <option value="Email">name</option>
                    <option value="Date" selected>date</option>
                </select>
            </div>
            <div class="emailtable">
                <table>
                    <tr>
                        <th>Email</th>
                        <th>provider</th>
                    </tr>
                    <?php foreach ($emails as $row => $email) : ?>
                        <tr>
                            <td> <?php print_r($email['Email']); ?> </td>
                            <td> <?php print_r($email['Name']); ?> </td>
                            <td>
                                <form method='post' action='/delete'>
                                    <input type="hidden" id="id" name="id" value='<?php echo $email['id']; ?>'>
                                    <input type="submit" value="delete">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>