<?php if (isset($data['success'])) : ?>
    <span class="bg-success text-light text-center w-50 mx-auto p-3 mt-3 d-block"><?= $data['success'] ?></span>
<?php endif; ?>
<?php if (isset($data['fail'])) : ?>
    <span class="bg-danger text-light text-center w-50 mx-auto p-3 mt-3 d-block"><?= $data['fail'] ?></span>
<?php endif; ?>
    <h4 class="text-center pb-2">Existing Students</h4>
<?php if (empty($data['activeStudents'])) : ?>
    <span class="bg-danger text-light text-center w-50 mx-auto p-3 mt-3 d-block">No active students</span>
<?php else : ?>
    <table class="table w-75 mx-auto">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Full Name</th>
            <th scope="col">Parent Name</th>
            <th scope="col">Relationship</th>
            <th scope="col">Contact Number</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['activeStudents'] as $student) : ?>
            <tr>
                <td><?= $student->full_name ?></td>
                <td><?= $student->parent_name ?></td>
                <td><?= $student->relationship ?></td>
                <td><?= $student->contact_number ?></td>
                <td>
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                        <input type="hidden" name="user_id" value="<?= $student->user_id ?>">
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
    <h4 class="text-center pt-3 pb-2">Deleted Students</h4>
<?php if (empty($data['deletedStudents'])) : ?>
    <span class="bg-danger text-light text-center w-50 mx-auto p-3 d-block">No active students</span>
<?php else : ?>
    <table class="table w-75 mx-auto">
        <thead class="thead-light">
        <tr>
            <th scope="col">Full Name</th>
            <th scope="col">Parent Name</th>
            <th scope="col">Relation</th>
            <th scope="col">Contact Number</th>
            <th scope="col">Release Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['deletedStudents'] as $student) : ?>
            <tr>
                <td><?= $student->full_name ?></td>
                <td><?= $student->parent_name ?></td>
                <td><?= $student->relationship ?></td>
                <td><?= $student->contact_number ?></td>
                <td><?= $student->left_on ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>