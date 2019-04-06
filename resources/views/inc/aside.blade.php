<?php
$access = UserApp::getrole_array($user['id']);
?>
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">{{config('app.name')}}</a>
        </div>
        @include('inc.access')
        <!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->