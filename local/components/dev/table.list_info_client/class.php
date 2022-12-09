<?php

    use Bitrix\Main,
        Bitrix\Main\Loader,
        Bitrix\Main\Localization\Loc as Loc,
        Bitrix\Main\Data\Cache,
        Bitrix\Main\Entity\Query,
        Bitrix\TaskTable;
    
    Loc::loadMessages(__FILE__);

    class TableListInfoClientComponent extends CBitrixComponent
    {
        
        public function __construct($component = null)
        {
            parent::__construct($component);
        }
        
        public function onPrepareComponentParams($arParams)
        {
            return $arParams;
        }

        public function executeComponent()
        {
            $this->getResult();
            $this->includeComponentTemplate();
        }
        
        protected function getResult()
        {
            $this->arResult['INFO_CLIENT'] = $this->getInfoClient();
        }
        
        public function getInfoClient()
        {
            $res = [];
            $cache = Cache::createInstance();
            if ($cache->initCache($this->arParams['CACHE_TIME'], $this->__name.'info_client'))
            {
                $res = $cache->getVars();
            } elseif($cache->startDataCache()) {
                $query = new Query(TaskTable::getEntity());
                $query
                    ->setSelect([
                        'clientID' => 'CLIENT.ID',
                        'clientName' => 'CLIENT.NAME',
                        'totalPriceF',
                        'totalPriceP'
                    ])
                    ->addSelect(Query::expr()->count('ID'), 'totalCountTasks')
                    ->registerRuntimeField(
                        'totalPriceF', [
                            'expression' => ['(' . $this->getSumPriceSubQueryFilterStatus('F') . ')', 'CLIENT.ID']
                        ]
                    )
                    ->registerRuntimeField(
                        'totalPriceP', [
                            'expression' => ['(' . $this->getSumPriceSubQueryFilterStatus('P') . ')', 'CLIENT.ID']
                        ]
                    )
                    ->setOrder(['CLIENT_ID' => 'asc'])
                    ->setGroup(['CLIENT_ID'])
                ;
                $resultQuery = $query->exec();
                $res = [];
                while($result = $resultQuery->fetch()) {
                    $res[] = $result;
                }
                $cache->endDataCache($res);
            }
            return $res;
        }
        
        public function getSumPriceSubQueryFilterStatus(string $statusCode) : string
        {
            $res = '';
            if ($statusCode) {
                $res = TaskTable::query()
                    ->addSelect(Query::expr()->sum('PRICE'), 'sum')
                    ->where('STATUS.CODE', '=', $statusCode)
                    ->where('CLIENT_ID', '=', new Bitrix\Main\DB\SqlExpression('%s'))
                    ->getQuery()
                ;
            }
            return $res;
        }
        
    }
