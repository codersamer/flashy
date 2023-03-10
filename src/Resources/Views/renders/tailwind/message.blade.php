<div {!! $message->buildAttributes(['class' => ['alert', 'alert-'.$class, 'alert-dismissible fade show' ]]) !!}>
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                @if($message->hasTitle())
                <h4 class="alert-heading">{{$message->getTitle()}}</h4>
                @endif
                @if($message->hasIcon())
                <i class="fa {{ $message->getIcon() }} me-2"></i>
                @endif
                {!! $message->getText() !!}
            </div>
        </div>
        @if ($message->hasButtons())
        <div class="row mt-3 gx-2">
            @foreach ($message->getButtons() as $button)
            <div class="col-auto">
                <a {!! $button->buildAttributes(['class' => 'btn btn-'.($button->getType()->value == 'outline' ? 'outline-' : '').$class]) !!}>
                    @if($button->hasIcon())
                    <i class="fa {{ $button->getIcon() }} me-2"></i>
                    @endif
                    {!! $button->getText() !!}
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
