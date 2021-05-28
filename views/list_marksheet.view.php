<h2 class="text-center pb-2">Submission List</h2>
<?php if (empty($data['submissions'])) : ?>
    <span class="bg-danger text-light text-center w-50 mx-auto p-3 mt-3 d-block">No assignment added yet</span>
<?php else : ?>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Assignment Title</th>
            <th scope="col">Subject Name</th>
            <th scope="col">Due Date</th>
            <?php if (!empty($data['submissions'][0]->full_name)) : ?>
                <th scope="col">Student Name</th>
            <?php endif; ?>
            <th scope="col">File</th>
            <th scope="col">Marks</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['submissions'] as $submission) : ?>
            <tr>
                <td><?= $submission->title ?></td>
                <td><?= $submission->subject_name ?></td>
                <td><?= date_format(date_create($submission->due_date), 'm/d/Y') ?></td>
                <?php if (!empty($submission->full_name)) : ?>
                    <td><?= $submission->full_name ?></td>
                <?php endif; ?>
                <td scope="col"><a target="_blank"
                                   href="./solutions/<?= $submission->file_name ?>"><?= $submission->file_name ?></a>
                </td>
                <?php if ($_SESSION['user']->role !== 'student') : ?>
                    <td>
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="submission" value="<?= $submission->submission_id ?>">
                                <input type="number" name="marks" min=0 max=100
                                       value="<?= $submission->marks ?? '' ?>" class="form-control" id="marks"
                                       aria-describedby="marksHelp" autocomplete="off" required>
                                <small class="text-danger"><?= $data['marksError'] ?? '' ?></small>
                            </div>
                        </form>
                    </td>
                <?php else : ?>
                    <td><?= $submission->marks ?? 'Not marked yet' ?></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>