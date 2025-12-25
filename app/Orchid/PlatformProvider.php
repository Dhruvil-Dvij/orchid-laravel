<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            // Menu::make('Get Started')
            //     ->icon('bs.book')
            //     ->title('Navigation')
            //     ->route(config('platform.index')),

            Menu::make('Crypto Baskets')
                ->icon('bs.basket')
                ->title('Navigation')
                ->route('platform.baskets'),

            // Menu::make('Sample Screen')
            //     ->icon('bs.collection')
            //     ->route('platform.example')
            //     ->badge(fn() => 6),

            // Menu::make('Form Elements')
            //     ->icon('bs.card-list')
            //     ->route('platform.example.fields')
            //     ->active('*/examples/form/*'),

            // Menu::make('Layouts Overview')
            //     ->icon('bs.window-sidebar')
            //     ->route('platform.example.layouts'),

            // Menu::make('Grid System')
            //     ->icon('bs.columns-gap')
            //     ->route('platform.example.grid'),

            // Menu::make('Charts')
            //     ->icon('bs.bar-chart')
            //     ->route('platform.example.charts'),

            // Menu::make('Cards')
            //     ->icon('bs.card-text')
            //     ->route('platform.example.cards')
            //     ->divider(),

            Menu::make('Wallet')
                ->icon('bs.wallet2')
                ->title('Funds')
                ->route('platform.wallet'),

            Menu::make(__('Add Fund'))
                ->icon('bs.wallet2')
                ->route('platform.funds.payment_details')
                ->permission('platform.funds.payment_details'),

            Menu::make('Owned Baskets')
                ->icon('bs.basket-fill')
                ->route('platform.owned-baskets')
                ->permission('platform.owned-baskets'),

            Menu::make(__('Fund Requests'))
                ->icon('bs.hourglass-split')
                ->title('User Requests')
                ->route('platform.systems.pending.requests')
                ->permission('platform.systems.pending.requests'),

            Menu::make(__('Withdraw Requests'))
                ->icon('bs.cash')
                ->route('platform.fund.withdraw_requests')
                ->permission('platform.fund.withdraw_requests'),

            Menu::make(__('KYC Requests'))
                ->icon('bs.shield-lock')
                ->route('platform.user.kyc.requests')
                ->permission('platform.user.kyc.requests'),
            
            Menu::make(__('Bank KYC Requests'))
                ->icon('bs.shield-check')
                ->route('platform.user.bank.kyc.requests')
                ->permission('platform.user.bank.kyc.requests'),

            Menu::make(__('Contact Requests'))
                ->icon('bs.envelope')
                ->route('platform.user.contact.requests')
                ->permission('platform.user.contact.requests'),


            Menu::make(__('Customer Support'))
                ->icon('bs.headset')
                ->route('platform.customer.support')
                ->permissions('platform.customer.support')
                ->title('Contact Support'),

            Menu::make(__('Support Request'))
                ->icon('bs.envelope-paper')
                ->route('platform.customer.support.list')
                ->permission('platform.customer.support.list'),

            Menu::make(__('Banks Details'))
                ->icon('bs.bank')
                ->route('platform.user.bank.list')
                ->permission('platform.user.bank.list')
                ->title("Account & Verification"),

            Menu::make(__('KYC Details'))
                ->icon('bs.shield-check')
                ->route('platform.user.kyc.submit')
                ->permission('platform.user.kyc.submit'),

            

            Menu::make(__('Markets'))
                ->icon('bs.graph-up-arrow')
                ->route('platform.markets')
                ->title('Market & Insights'),
            
            Menu::make(__('News'))
                ->icon('bs.newspaper')
                ->route('platform.news'),
            
            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),

            Menu::make(__('Referral Settings'))
                ->icon('bs.percent')
                ->route('platform.systems.settings')
                ->permission('platform.systems.settings'),


            // Menu::make('Documentation')
            //     ->title('Docs')
            //     ->icon('bs.box-arrow-up-right')
            //     ->url('https://orchid.software/en/docs')
            //     ->target('_blank'),

            // Menu::make('Changelog')
            //     ->icon('bs.box-arrow-up-right')
            //     ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
            //     ->target('_blank')
            //     ->badge(fn() => Dashboard::version(), Color::DARK),


        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users'))
                ->addPermission('platform.systems.settings', __('Referral Settings'))
                ->addPermission('platform.systems.pending.requests', __('Pending Requests'))
                ->addPermission('platform.user.kyc.requests', __('KYC Requests'))
                ->addPermission('platform.user.bank.kyc.requests', __('Bank KYC Requests'))
                ->addPermission('platform.user.contact.requests', __('Contact Requests'))
                ->addPermission('platform.customer.support', __('Customer Support'))
                ->addPermission('platform.customer.support.list', __('Support Request'))
                ->addPermission('platform.user.bank.list', __('Banks Details'))
                ->addPermission('platform.funds.payment_details', __('Add Funds'))
                ->addPermission('platform.user.kyc.submit', __('KYC Details')),
            ItemPermission::group(__('Funds'))
                ->addPermission('platform.funds.wallet', __('Wallet'))
                ->addPermission('platform.funds.edit', __('Wallet Transactions'))
                ->addPermission('platform.owned-baskets', __('Owned Baskets'))
                ->addPermission('platform.funds.direct.add', __('Direct Add Funds'))
                ->addPermission('platform.fund.withdraw_requests', __('Withdraw Requests')),
        ];
    }
}
