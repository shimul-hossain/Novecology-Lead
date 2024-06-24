@forelse ($user_assignee as $user_assign)
@if ($loop->index < 10)
    <li class="dashboard-list__item">
        <div class="media media--warning">
            <div class="media-header rounded">
                <i class="bi bi-person-square"></i>
            </div>
            <div class="media-body">
                <h4 class="media-body__title font-weight-normal">{{ $user_assign['name'] }}</h4>
                <p class="media-body__sub-title d-flex">
                    {{ $user_assign['role'] }}
                    <span class="text-success font-weight-bold ml-auto">{{ $user_assign['ticket'] }}</span>
                </p>
            </div>
        </div>
    </li>
@endif
@empty
<li class="dashboard-list__item">
    <div class="media media--warning justify-content-center">
        <h3>Aucun résultat trouvé.</h3>
    </div>
</li>
@endforelse