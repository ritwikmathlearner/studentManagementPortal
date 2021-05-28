<h2 class="text-center pb-2">Assignment List</h2>
<?php if (empty($data['assignmentList'])) : ?>
    <span class="bg-danger text-light text-center w-50 mx-auto p-3 mt-3 d-block">No assignment added yet</span>
<?php else : ?>
    <table class="table w-50 mx-auto">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Subject Name</th>
            <th scope="col">Due Date</th>
            <th scope="col">Lecture Title</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['assignmentList'] as $assignment) : ?>
            <tr>
                <td><?= $assignment->subject_name ?></td>
                <td><?= date_format(date_create($assignment->due_date), 'm/d/Y') ?></td>
                <td><?= $assignment->title ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>