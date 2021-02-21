<?php
session_start(); ?>
<div class="header">
    <div class="container">
        <div class="row">
   
            <div class="d-flex justify-content-between align-items-center">
            <?php if ($_SESSION['username']): ?>
                <div class="userDetail d-flex align-items-center">
                    <div class="logo d-flex justify-content-center align-items-center">
                        <?php if ($_SESSION['username']): ?>
                        <span><?php echo $_SESSION['username'][0]; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="detail d-flex flex-column ml-4">
                        <span class="font-weight-bold">Howdy!</span>
                        <span><?php echo $_SESSION['username']; ?></span>
                    </div>
                </div>
                <?php endif; ?>
                <div class="logout">
                    <a href="/logout">
                        <button type="button">Logout</button>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>