<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Test\Integration\Rule;

use Magento\TestFramework\Helper\Bootstrap;
use MSP\NotifierEvent\Model\GetRulesIdsByEventInterface;
use MSP\NotifierEvent\Model\GetRulesIdsByEventRegistry;

/**
 * @magentoDataFixture MSP_NotifierEvent::Test/Integration/Rule/_files/rules.php
 */
class GetRulesByEventTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var GetRulesIdsByEventInterface
     */
    private $getRuleIdsByEvent;

    /**
     * @var GetRulesIdsByEventRegistry
     */
    private $getRuleIdsByEventRegistry;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        // @codingStandardsIgnoreStart
        $this->getRuleIdsByEvent = Bootstrap::getObjectManager()->get(GetRulesIdsByEventInterface::class);
        $this->getRuleIdsByEventRegistry = Bootstrap::getObjectManager()->get(GetRulesIdsByEventRegistry::class);
        // @codingStandardsIgnoreEnd
    }

    /**
     * Test an event matching a single rule
     */
    public function testSingle()
    {
        $this->getRuleIdsByEventRegistry->clearRegistry();
        $ruleIds = $this->getRuleIdsByEvent->execute('test_event_3');
        $this->assertEquals(1, count($ruleIds), 'Could not correctly retrieve a single event');
    }

    /**
     * Test an event matching 2 rules
     */
    public function testDouble()
    {
        $this->getRuleIdsByEventRegistry->clearRegistry();
        $ruleIds = $this->getRuleIdsByEvent->execute('test_event_1');
        $this->assertEquals(2, count($ruleIds), 'Could not correctly retrieve a double event');
    }

    /**
     * Testing an event matching a disabled rule
     */
    public function testDisabled()
    {
        $this->getRuleIdsByEventRegistry->clearRegistry();
        $ruleIds = $this->getRuleIdsByEvent->execute('test_event_4');
        $this->assertEquals(0, count($ruleIds), 'Retrieved a disabled rule');
    }
}
