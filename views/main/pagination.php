<div class="d-flex justify-content-center align-items-center mt-3">
    <ul class="pagination m-0">
        <li class="page-item">
            <a class="page-link <?= ($pageNumber == 1) ? 'disabled' : '' ?>" href="?page=<?= $pageNumber - 1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li class="page-item <?= ($pageNumber == 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=1">First</a>
        </li>
        <li class="page-item">
            <a class="page-link <?= ($pageNumber == $totalPosts) ? 'disabled' : '' ?>" href="?page=<?= $totalPosts; ?>">Last</a>
        </li>
        <li class="page-item">
            <a class="page-link <?= ($pageNumber == $totalPosts) ? 'disabled' : '' ?>" href="?page=<?= $pageNumber + 1 ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</div>