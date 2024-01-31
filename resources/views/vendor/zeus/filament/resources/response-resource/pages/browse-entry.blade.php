<div x-data class="w-full mx-4 my-6 space-y-4">
    @php
        $getRecord = $getRecord();
    @endphp
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <div class="md:col-span-2">
            <x-filament::section>
                @foreach ($getRecord->fieldsResponses as $resp)
                    @if ($resp->field !== null)
                        <div class="py-2 overflow-auto text-ellipsis">
                            <p>{{ $resp->field->name ?? '' }}</p>
                            <p class="mb-2 font-semibold">
                                {!! (new $resp->field->type())->getResponse($resp->field, $resp) !!}
                            </p>
                            <hr />
                        </div>
                    @endif
                @endforeach
            </x-filament::section>
        </div>
        <div class="space-y-4">
            <x-filament::section>
                <x-slot name="heading" class="text-primary-600">
                    {{ __('User Details') }}
                </x-slot>
                @if ($getRecord->user_id === null)
                    <span>{{ __('By') }} {{ __('Visitor') }}</span>
                @else
                    <div class="flex items-center gap-2">
                        <div class="p-2 text-lg text-white rounded-full bg-primary-600">
                            {{ strtoupper(substr($getRecord->user->name, 0, 2)) }}
                        </div>
                        <p class="flex flex-col gap-1">
                            <span>{{ $getRecord->user->name ?? '' }}</span>
                            <span>{{ $getRecord->user->email ?? '' }}</span>
                        </p>
                    </div>
                @endif
                <p class="flex flex-col gap-1 my-1">
                    <span class="text-base font-light">{{ __('created at') }}:</span>
                    <span
                        class="font-semibold">{{ $getRecord->created_at->format('Y.m/d') }}-{{ $getRecord->created_at->format('h:i a') }}</span>
                </p>
            </x-filament::section>
            <x-filament::section>
                <x-slot name="heading" class="text-primary-600">
                    <p class="font-semibold text-primary-600">{{ __('Entry Details') }}</p>
                </x-slot>

                <div class="flex flex-col mb-4">
                    <span class="text-gray-600">{{ __('Form') }}:</span>
                    <span>{{ $getRecord->form->name ?? '' }}</span>
                </div>

                <div class="mb-4">
                    <span>{{ __('status') }}</span>
                    @php $getStatues = $getRecord->statusDetails() @endphp
                    <span class="{{ $getStatues['class'] }}"
                        x-tooltip="{
                                    content: @js(__('status')),
                                    theme: $store.theme,
                                  }">
                        @svg($getStatues['icon'], 'w-4 h-4 inline')
                        {{ $getStatues['label'] }}
                    </span>
                </div>

                <div class="flex flex-col">
                    <span>{{ __('Notes') }}:</span>
                    {!! nl2br($getRecord->notes) !!}
                </div>
            </x-filament::section>
        </div>
    </div>
</div>
