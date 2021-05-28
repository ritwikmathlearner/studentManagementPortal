<?php if(isset($data['success'])) : ?>
    <span class="bg-success text-light text-center w-50 mx-auto p-3 mt-3 d-block"><?= $data['success'] ?></span>
<?php endif; ?>
<?php if(isset($data['fail'])) : ?>
    <span class="bg-danger text-light text-center w-50 mx-auto p-3 mt-3 d-block"><?= $data['fail'] ?></span>
<?php endif; ?>
<h4 class="text-center pb-2">Existing Faculties</h4>
<?php if (empty($data['activeFaculties'])) : ?>
    <span class="bg-danger text-light text-center w-50 mx-auto p-3 mt-3 d-block">No active faculties</span>
<?php else : ?>
    <table class="table w-75 mx-auto">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Full Name</th>
            <th scope="col">User Name</th>
            <th scope="col">Qualification</th>
            <th scope="col">Contact Number</th>
            <th scope="col">Subject(s)</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['activeFaculties'] as $faculty) : ?>
            <tr>
                <td><?= $faculty->full_name ?></td>
                <td><?= $faculty->username ?></td>
                <td><?= $faculty->qualification ?></td>
                <td><?= $faculty->contact_number ?></td>
                <td><?= str_replace(',', ', ', getAssignedSubject($faculty->user_id, $data['pdo'])) ?></td>
                <td>
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                        <input type="hidden" name="user_id" value="<?= $faculty->user_id ?>">
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<h4 class="text-center pt-3 pb-2">Deleted Faculties</h4>
<?php if (empty($data['deletedFaculties'])) : ?>
    <span class="bg-danger text-light text-center w-50 mx-auto p-3 d-block">No active faculties</span>
<?php else : ?>
    <table class="table w-75 mx-auto">
        <thead class="thead-light">
        <tr>
            <th scope="col">Full Name</th>
            <th scope="col">Qualification</th>
            <th scope="col">Contact Number</th>
            <th scope="col">Join Date</th>
            <th scope="col">Release Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['deletedFaculties'] as $faculty) : ?>
            <tr>
                <td><?= $faculty->full_name ?></td>
                <td><?= $faculty->qualification ?></td>
                <td><?= $faculty->contact_number ?></td>
                <td><?= $faculty->join_date ?></td>
                <td><?= $faculty->left_on ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>