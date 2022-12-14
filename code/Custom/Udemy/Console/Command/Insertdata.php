<?php
namespace Custom\Udemy\Console\Command;
use Symfony\Component\Console\Command\Command;
use Custom\Udemy\Model\ViewFactory as ViewFactory;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Console\Cli;

class Insertdata extends Command{
    const INPUT_KEY_TITLE='title';
    const INPUT_KEY_DESCRIPTION='content';

    private $viewFactory;

    public function __construct(ViewFactory $viewFactory)
    {
        $this->viewFactory=$viewFactory;

        parent::__construct();
    }
    protected function configure(){
        $this->setName('console:item:add')
            ->addArgument(
                self::INPUT_KEY_TITLE,
                InputArgument::REQUIRED,
                'item name'
            )->addArgument(
                self::INPUT_KEY_DESCRIPTION,
                InputArgument::REQUIRED,
                'item description'
            );
        parent::configure();
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $item=$this->viewFactory->create();
        $item->setTitle($input->getArgument(self::INPUT_KEY_TITLE));
        $item->setContent($input->getArgument(self::INPUT_KEY_DESCRIPTION));
        $item->setIsObjectNew(true);
        $item->save();
        return Cli::RETURN_SUCCESS;
    }

}