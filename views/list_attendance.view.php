<h2 class="text-center pb-2">Attendance List(Only Present)</h2>
<?php if (empty($data['attendanceList'])) : ?>
    <span class="bg-danger text-light text-center w-50 mx-auto p-3 mt-3 d-block">No attendance marked yet</span>
<?php else : ?>
    <table class="table w-50 mx-auto">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Subject Name</th>
            <th scope="col">Class Date</th>
            <th scope="col">Lecture Title</th>
            <th scope="col">Student Name</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['attendanceList'] as $attendance) : ?>
            <tr>
                <td><?= $attendance->subject_name ?></td>
                <td><?= date_format(date_create($attendance->class_date), 'm/d/Y') ?></td>
                <td><?= $attendance->lecture_title ?></td>
                <td><?= $attendance->full_name ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>