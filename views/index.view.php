<h2 class="text-center">Welcome abroad <?= $_SESSION['user']->full_name ?></h2>

<h4 class="mt-5 text-center">You Have Below Authorities</h4>
<ul class="list-group w-50 mx-auto">
    <?php if ($_SESSION['user']->role === 'admin') : ?>
        <li class="list-group-item">Assign Subject to Faculty</li>
        <li class="list-group-item">Add New Faculty</li>
        <li class="list-group-item">See List Faculty</li>
        <li class="list-group-item">Soft Delete a Faculty</li>
        <li class="list-group-item">See Student List</li>
        <li class="list-group-item">Soft Delete Student</li>
    <?php endif; ?>
    <?php if ($_SESSION['user']->role === 'faculty') : ?>
        <li class="list-group-item">Add New Student</li>
        <li class="list-group-item">Add Student Attendance</li>
        <li class="list-group-item">Allot Assignments</li>
        <li class="list-group-item">Submit Student Result</li>
    <?php endif; ?>
    <?php if ($_SESSION['user']->role === 'student') : ?>
        <li class="list-group-item">See Own Attendance</li>
        <li class="list-group-item">See Own Mark sheet</li>
        <li class="list-group-item">See List of Assignments</li>
    <?php endif; ?>
</ul>

