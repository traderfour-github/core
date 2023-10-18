<?php

namespace App\Rules\Bridges;

use Illuminate\Contracts\Validation\Rule;

class MT5CommandRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $mt5_commands = [
            'AccountInfoDouble' , 'AccountInfoInteger' ,'AccountInfoString' , 'acos' , 'Alert' , 'ArrayBsearch' ,'ArrayCompare',
            'ArrayCopy' , 'ArrayFill' , 'ArrayFree' , 'ArrayGetAsSeries' , 'ArrayInitialize' , 'ArrayIsDynamic' , 'ArrayIsSeries',
            'ArrayMaximum','ArrayMinimum','ArrayRange','ArrayResize','ArraySetAsSeries','ArraySize','ArraySort','ArrayPrint',
            'ArrayInsert','ArrayRemove','ArrayReverse','ArraySwap','asin','atan','Bars','BarsCalculated','CalendarCountryById','CalendarEventById',
            'CalendarValueById','CalendarCountries','CalendarEventByCountry','CalendarEventByCurrency','CalendarValueHistoryByEvent',
            'CalendarValueHistory','CalendarValueLastByEvent','CalendarValueLast','ceil','CharArrayToString','ChartApplyTemplate',
            'ChartClose','ChartFirst','ChartGetDouble','ChartGetInteger','ChartGetString','ChartID','ChartIndicatorAdd','ChartIndicatorDelete',
            'ChartIndicatorGet','ChartIndicatorName','ChartIndicatorsTotal','ChartNavigate','ChartNext','ChartOpen','CharToString',
            'ChartPeriod','ChartPriceOnDropped','ChartRedraw','ChartSaveTemplate','ChartScreenShot','ChartSetDouble','ChartSetInteger',
            'ChartSetString','ChartSetSymbolPeriod','ChartSymbol','ChartTimeOnDropped','ChartTimePriceToXY','ChartWindowFind','ChartWindowOnDropped',
            'ChartXOnDropped','ChartXYToTimePrice','ChartYOnDropped','CheckPointer','CLBufferCreate','CLBufferFree','CLBufferRead',
            'CLBufferWrite','CLContextCreate','CLContextFree','CLExecute','CLGetDeviceInfo','CLGetInfoInteger','CLHandleType','CLKernelCreate',
            'CLKernelFree','CLProgramCreate','CLProgramFree','CLSetKernelArg','CLSetKernelArgMem','ColorToARGB','ColorToString',
            'Comment','CopyBuffer','CopyClose','CopyHigh','CopyLow','CopyOpen','CopyRates','CopyRealVolume','CopySpread',
            'CopyTicks','CopyTickVolume','CopyTime','cos','CryptDecode','CryptEncode','CustomSymbolCreate','CustomSymbolDelete',
            'CustomSymbolSetInteger','CustomSymbolSetDouble','CustomSymbolSetString','CustomSymbolSetMarginRate','CustomSymbolSetSessionQuote',
            'CustomSymbolSetSessionTrade','CustomRatesDelete','CustomRatesReplace','CustomRatesUpdate','CustomTicksAdd',
            'CustomTicksDelete','CustomTicksReplace','CustomBookAdd','DatabaseOpen','DatabaseClose','DatabaseImport','DatabaseExport',
            'DatabasePrint','DatabaseTableExists','DatabaseExecute','DatabasePrepare','DatabaseReset','DatabaseBind','DatabaseBindArray',
            'DatabaseRead','DatabaseReadBind','DatabaseFinalize','DatabaseTransactionBegin','DatabaseTransactionCommit','DatabaseTransactionRollback',
            'DatabaseColumnsCount','DatabaseColumnName','DatabaseColumnType','DatabaseColumnSize','DatabaseColumnText','DatabaseColumnInteger',
            'DatabaseColumnLong','DatabaseColumnDouble','DatabaseColumnBlob','DebugBreak','Digits','DoubleToString','DXContextCreate',
            'DXContextSetSize','DXContextSetSize','DXContextClearColors','DXContextClearDepth','DXContextGetColors','DXContextGetDepth',
            'DXBufferCreate','DXTextureCreate','DXInputCreate','DXInputSet','DXShaderCreate','DXShaderSetLayout','DXShaderInputsSet',
            'DXShaderTexturesSet','DXDraw','DXDrawIndexed','DXPrimiveTopologySet','DXBufferSet','DXShaderSet','DXHandleType','DXRelease',
            'EnumToString','EventChartCustom','EventKillTimer','EventSetMillisecondTimer','EventSetTimer','exp','ExpertRemove',
            'fabs','FileClose','FileCopy','FileDelete','FileFindClose','FileFindFirst','FileFindNext','FileFlush','FileGetInteger',
            'FileIsEnding','FileIsExist','FileIsLineEnding','FileMove','FileOpen','FileReadArray','FileReadBool','FileReadDatetime',
            'FileReadDouble','FileReadFloat','FileReadInteger','FileReadLong','FileReadNumber','FileReadString','FileReadStruct',
            'FileSeek','FileSize','FileTell','FileWrite','FileWriteArray','FileWriteDouble','FileWriteFloat','FileWriteInteger',
            'FileWriteLong','FileWriteString','FileWriteStruct','floor','fmax','fmin','fmod','FolderClean','FolderCreate','FolderDelete',
            'FrameAdd','FrameFilter','FrameFirst','FrameInputs','FrameNext','GetLastError','GetPointer','GetTickCount','GlobalVariableCheck',
            'GlobalVariableDel','GlobalVariableGet','GlobalVariableName','GlobalVariablesDeleteAll','GlobalVariableSet','GlobalVariableSetOnCondition',
            'GlobalVariablesFlush','GlobalVariablesTotal','GlobalVariableTemp','GlobalVariableTime','HistoryDealGetDouble',
            'HistoryDealGetInteger','HistoryDealGetString','HistoryDealGetTicket','HistoryDealSelect','HistoryDealsTotal',
            'HistoryOrderGetDouble','HistoryOrderGetInteger','HistoryOrderGetString','HistoryOrderGetTicket','HistoryOrderSelect',
            'HistoryOrdersTotal','HistorySelect','HistorySelectByPosition','iBars','iBarShift','iClose','iHigh','iHighest','iLow',
            'iLowest','iOpen','iTime','iTickVolume','iRealVolume','iVolume','iSpread','iAD','iADX','iADXWilder','iAlligator',
            'iAMA','iAO','iATR','iBands','iBearsPower','iBullsPower','iBWMFI','iCCI','iChaikin','iCustom','iDEMA','iDeMarker',
            'iEnvelopes','iForce','iFractals','iFrAMA','iGator','iIchimoku','iMA','iMACD','iMFI','iMomentum','IndicatorCreate',
            'IndicatorParameters','IndicatorRelease','IndicatorSetDouble','IndicatorSetInteger','IndicatorSetString','IntegerToString',
            'iOBV','iOsMA','iRSI','iRVI','iSAR','IsStopped','iStdDev','iStochastic','iTEMA','iTriX','iVIDyA','iVolumes',
            'iWPR','log','log10','MarketBookAdd','MarketBookGet','MarketBookRelease','MathAbs','MathArccos','MathArcsin',
            'MathArctan','MathCeil','MathCos','MathExp','MathFloor','MathIsValidNumber','MathLog','MathLog10','MathMax',
            'MathMin','MathMod','MathPow','MathRand','MathRound','MathSin','MathSqrt','MathSrand','MathTan','MessageBox',
            'MQLInfoInteger','MQLInfoString','MT5Initialize','MT5Shutdown','MT5TerminalInfo','MT5Version','MT5CopyRatesFrom',
            'MT5CopyRatesFromPos','MT5CopyRatesRange','MT5CopyTicksFrom','MT5CopyTicksRange','NormalizeDouble','ObjectCreate',
            'ObjectDelete' ,'ObjectFind' , 'ObjectGetDouble','ObjectGetInteger','ObjectGetString','ObjectGetTimeByValue',
            'ObjectGetValueByTime','ObjectMove','ObjectName','ObjectsDeleteAll','ObjectSetDouble','ObjectSetInteger',
            'ObjectSetString','ObjectsTotal','OnStart','OnInit','OnDeinit','OnTick','OnCalculate','OnTimer','OnTrade','OnTradeTransaction',
            'OnBookEvent','OnChartEvent','OnTester','OnTesterInit','OnTesterDeinit','OnTesterPass','OrderCalcMargin','OrderCalcProfit',
            'OrderCheck','OrderGetDouble','OrderGetInteger','OrderGetString','OrderGetTicket','OrderSelect','OrderSend',
            'OrderSendAsync','OrdersTotal','ParameterGetRange','ParameterSetRange','Period','PeriodSeconds','PlaySound','PlotIndexGetInteger',
            'PlotIndexSetDouble','PlotIndexSetInteger','PlotIndexSetString','Point','PositionGetDouble','PositionGetInteger',
            'PositionGetString','PositionGetSymbol','PositionGetTicket','PositionSelect','PositionSelectByTicket','PositionsTotal',
            'pow','Print','PrintFormat','rand','ResetLastError','ResourceCreate','ResourceFree','ResourceReadImage','ResourceSave',
            'round','SendFTP','SendMail','SendNotification','SeriesInfoInteger','SetIndexBuffer','ShortArrayToString','ShortToString',
            'SignalBaseGetDouble','SignalBaseGetInteger','SignalBaseGetString','SignalBaseSelect','SignalBaseTotal','SignalInfoGetDouble',
            'SignalInfoGetInteger','SignalInfoGetString','SignalInfoSetDouble','SignalInfoSetInteger','SignalSubscribe','SignalUnsubscribe',
            'sin','Sleep','SocketCreate','SocketClose','SocketConnect','SocketIsConnected','SocketIsReadable','SocketIsWritable',
            'SocketTimeouts','SocketRead','SocketSend','SocketTlsHandshake','SocketTlsCertificate','SocketTlsRead','SocketTlsReadAvailable',
            'SocketTlsSend','sqrt','srand','StringAdd','StringBufferLen','StringCompare','StringConcatenate','StringFill','StringFind',
            'StringFormat','StringGetCharacter','StringInit','StringLen','StringReplace','StringSetCharacter','StringSplit','StringSubstr',
            'StringToCharArray','StringToColor','StringToDouble','StringToInteger','StringToLower','StringToShortArray','StringToTime',
            'StringToUpper','StringTrimLeft','StringTrimRight','StructToTime','Symbol','SymbolInfoDouble','SymbolInfoInteger',
            'SymbolInfoMarginRate','SymbolInfoSessionQuote','SymbolInfoSessionTrade','SymbolInfoString','SymbolInfoTick','SymbolIsSynchronized',
            'SymbolName','SymbolSelect','SymbolsTotal','tan','TerminalClose','TerminalInfoDouble','TerminalInfoInteger',
            'TerminalInfoString','TesterStatistics','TextGetSize','TextOut','TextSetFont','TimeCurrent','TimeDaylightSavings',
            'TimeGMT','TimeGMTOffset','TimeLocal','TimeToString','TimeToStruct','TimeTradeServer','UninitializeReason','WebRequest',
            'ZeroMemory'
        ];

        return in_array($value , $mt5_commands);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The desired command was not found.';
    }
}
