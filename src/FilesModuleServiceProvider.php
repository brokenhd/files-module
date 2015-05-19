<?php namespace Anomaly\FilesModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class FilesModuleServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule
 */
class FilesModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/files'                                 => 'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@redirect',
        'admin/files/browser'                         => 'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@index',
        'admin/files/folders/create/{disk}/{folder?}' => 'Anomaly\FilesModule\Http\Controller\Admin\FoldersController@create',
        'admin/files/disks'                           => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@index',
        'admin/files/disks/create'                    => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@create',
        'admin/files/disks/edit/{id}'                 => 'Anomaly\FilesModule\Http\Controller\Admin\DisksController@edit',
        'admin/files/ajax/choose_adapter'             => 'Anomaly\FilesModule\Http\Controller\Admin\AjaxController@chooseAdapter',
        'admin/files/settings'                        => 'Anomaly\FilesModule\Http\Controller\Admin\SettingsController@edit',
        'files/upload'                                => 'Anomaly\FilesModule\Http\Controller\UploaderController@upload',
    ];

    /**
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        'Anomaly\FilesModule\Disk\DiskModel'     => 'Anomaly\FilesModule\Disk\DiskModel',
        'Anomaly\FilesModule\File\FileModel'     => 'Anomaly\FilesModule\File\FileModel',
        'Anomaly\FilesModule\Folder\FolderModel' => 'Anomaly\FilesModule\Folder\FolderModel'
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface'     => 'Anomaly\FilesModule\Disk\DiskRepository',
        'Anomaly\FilesModule\File\Contract\FileRepositoryInterface'     => 'Anomaly\FilesModule\File\FileRepository',
        'Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface' => 'Anomaly\FilesModule\Folder\FolderRepository',
        'Anomaly\FilesModule\Adapter\StorageAdapterManager'             => 'Anomaly\FilesModule\Adapter\StorageAdapterManager',
        'Anomaly\FilesModule\FilesManager'                              => 'Anomaly\FilesModule\FilesManager'
    ];

    /**
     * The event listeners.
     *
     * @var array
     */
    protected $listeners = [
        'Anomaly\Streams\Platform\Application\Event\ApplicationHasLoaded' => [
            'Anomaly\FilesModule\Disk\Listener\ExtendFilesystem'
        ]
    ];

    /**
     * Map additional routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router
            ->any(
                'admin/files/browser/{disk?}/{path?}',
                'Anomaly\FilesModule\Http\Controller\Admin\BrowserController@index'
            )
            ->where('disk', '^[a-z0-9_]+$')
            ->where('path', '(.*)');
    }
}
