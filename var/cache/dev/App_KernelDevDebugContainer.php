<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerD2cEjfu\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerD2cEjfu/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerD2cEjfu.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerD2cEjfu\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerD2cEjfu\App_KernelDevDebugContainer([
    'container.build_hash' => 'D2cEjfu',
    'container.build_id' => 'ced1b7da',
    'container.build_time' => 1613496929,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerD2cEjfu');
