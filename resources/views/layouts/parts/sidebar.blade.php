
    <div class=" text-gray-200 py-3 divide-y-2">
        <a href="{{ route('dashboard') }}">
            <div class="py-5 hover:bg-secondary px-3 rounded-sm cursor-pointer">
                <p class="px-5 font-bold"> <i class="fas fa-chart-line"></i> Dashboard</p>
            </div>
        </a>
        <a href="{{ route('vote.statistics') }}">
            <div class="py-5 hover:bg-secondary px-3 rounded-sm cursor-pointer">
                <p class="px-5 font-bold"> <i class="fas fa-poll"></i> Votes</p>
            </div>
        </a>
        <a href="{{ route('contest.index') }}">
            <div class="py-5 hover:bg-secondary px-3 rounded-sm cursor-pointer">
                <p class="px-5 font-bold"> <i class="fas fa-trophy"></i> Contests</p>
            </div>
        </a>
        <a href="{{ route('pay.request') }}">
            <div class="py-5 hover:bg-secondary px-3 rounded-sm cursor-pointer">
                <p class="px-5 font-bold"> <i class="fas fa-money-bill"></i> Pending Payments</p>
            </div>
        </a>
        {{--<a href="{{ route('finance.index') }}">
            <div class="py-5 hover:bg-secondary px-3 rounded-sm cursor-pointer">
                <p class="px-5 font-bold"> <i class="fas fa-money-bill"></i> Finance</p>
            </div>
        </a>--}}
    </div>