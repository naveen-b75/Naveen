<?php
namespace Helloworld\Mymodule\Console\Command;

use Symfony\Component\Console\Command\Command;
use Helloworld\Mymodule\Model\CurdFactory;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Console\Cli;

class InsertData extends Command{
    protected $ModalFactory;
    const INPUT_KEY_NAME='name';
    const INPUT_KEY_DESCRIPTION='description';

    public function __construct(CurdFactory $curdFactory)
    {
        $this->ModalFactory=$curdFactory;
        parent::__construct();
    }
    /** configure() method is used to set the name, description,
     * command line arguments of the magento 2 add command line
     */
    protected function configure()
    {
        $this->setName('console:helloworld:add')
            ->addArgument(
                self::INPUT_KEY_NAME,
                InputArgument::REQUIRED,
                'name'
            )->addArgument(
                self::INPUT_KEY_DESCRIPTION,
                InputArgument::REQUIRED,
                'description'
    );
        parent::configure();
    }

    /** execute() method will run when we call this command line via console. */

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $modal=$this->ModalFactory->create();
        $modal->setName($input->getArgument(self::INPUT_KEY_NAME));
        $modal->setDescrtiption($input->getArgument(self::INPUT_KEY_DESCRIPTION));
        $modal->setIsObjectNew(true);
        $modal->save();
        return Cli::RETURN_SUCCESS;
    }
}