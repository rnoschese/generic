<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">
    <div class="sidebar-menu nav-collapse">
        <div class="divide-20"></div>
        <!-- SEARCH BAR -->
        <div id="search-bar">
            <input class="search" type="text" placeholder="Search"><i class="fa fa-search search-icon"></i>
        </div>

        <ul>
            <?php foreach ($menu as $item): ?>
                <?php if (count($item['sottoMenu']) > 0): ?>
                    <?php $n = array_search('active',array_column($item['sottoMenu'], 'active')) === false ? 0 : 1; ?>

                    <li class="has-sub <?= $n > 0 ? 'open' : '' ?>">
                        <a href="javascript:;" class="">
                            <i class="<?= $item['icon'] ?> fa-fw"></i> <span class="menu-text"><?= $item['nome'] ?> </span>
                            <span class="arrow <?= $n > 0 ? 'open' : '' ?>"></span>
                        </a>
                        <ul class="sub" style="<?= $n > 0 ? 'display: block' : 'display: none' ?>">
                            <?php foreach ($item['sottoMenu'] as $itemS): ?>
                                <li><a class="" href="/<?= $itemS['url'] ?>"><span class="sub-menu-text"><?= $itemS['nome'] ?></span></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="<?= $item['active'] ?>">
                        <a href="/<?= $item['url'] ?>">
                            <i class="fa <?= $item['icon'] ?> fa-fw"></i> <span class="menu-text"><?= $item['nome'] ?></span>
                            <span class="selected"></span>
                        </a>					
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>

    </div>
</div>
<!-- /SIDEBAR -->