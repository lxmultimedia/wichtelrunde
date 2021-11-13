<div class="bg-gray-700 text-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
  @if(!empty($successMsg))
  <div class="text-center py-4 lg:px-4">
    <div
      class="
        p-2
        bg-indigo-800
        items-center
        text-indigo-100
        leading-none
        lg:rounded-full
        flex
        lg:inline-flex
      "
      role="alert"
    >
      <span
        class="
          flex
          rounded-full
          bg-indigo-500
          uppercase
          px-2
          py-1
          text-xs
          font-bold
          mr-3
        "
        >Fertig</span
      >
      <span class="font-semibold mr-2 text-left flex-auto">{{
        $successMsg
      }}</span>
      <svg
        class="fill-current opacity-75 h-4 w-4"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
      >
        <path
          d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"
        />
      </svg>
    </div>
  </div>
  @endif
  <div class="stepwizard">
    <div class="stepwizard-row setup-panel">
      <div class="multi-wizard-step">
        <a
          href="#step-1"
          type="button"
          class="btn {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}"
          >1</a
        >
      </div>
      <div class="multi-wizard-step">
        <a
          href="#step-2"
          type="button"
          class="btn {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}"
          >2</a
        >
      </div>
      <div class="multi-wizard-step">
        <a
          href="#step-3"
          type="button"
          class="btn {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}"
          disabled="disabled"
          >3</a
        >
      </div>
    </div>
  </div>
  <div
    class="row setup-content {{ $currentStep != 1 ? 'display-none' : '' }} my-7"
    id="step-1"
  >
    <div class="col-md-12">
      <div class="w-full flex flex-col content-end">
        <label class="mb-3 block" for="title">Anzahl Mitarbeiter:</label>
        <input
          type="text"
          wire:model="total_members"
          class="
            shadow
            appearance-none
            border
            rounded
            w-full
            py-2
            px-3
            text-gray-700
            leading-tight
            focus:outline-none focus:shadow-outline
          "
          id="anzahl_ma"
        />
        @error('total_members')
        <span class="error">{{ $message }}</span> @enderror

        <button
          class="btn btn-primary nextBtn btn-lg mt-6 block"
          wire:click="firstStepSubmit"
          type="button"
        >
          Weiter
        </button>
      </div>
    </div>
  </div>
  <div
    class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }} my-7"
    id="step-2"
  >
    <div class="col-md-12">
      <div class="w-full flex flex-col content-end">
        @for ($i = 1; $i <= $total_members; $i++)
        <div class="mt-4 mb-8">
          <h4 class="border-b mb-2">Mitarbeiter {{ $i }}</h4>
          <label class="mt-3 block" for="title">Name:</label>
          <input
            type="text"
            wire:model="members.{{ $i }}.name"
            class="
              shadow
              appearance-none
              border
              rounded
              w-full
              py-2
              px-3
              text-gray-700
              leading-tight
              focus:outline-none focus:shadow-outline
            "
            id="member{{ $i }}"
          />
          @error('members')
          <span class="error">{{ $message }}</span> @enderror
          @error('members.'.$i.'.name')
          <span class="error">{{ $message }}</span> @enderror
          <label class="mt-3 block" for="title">E-Mail:</label>
          <input
            type="text"
            wire:model="members.{{ $i }}.email"
            class="
              shadow
              appearance-none
              border
              rounded
              w-full
              py-2
              px-3
              text-gray-700
              leading-tight
              focus:outline-none focus:shadow-outline
            "
            id="email{{ $i }}"
          />
          @error('members')
          <span class="error">{{ $message }}</span> @enderror
          @error('members.'.$i.'.email')
          <span class="error">{{ $message }}</span> @enderror
        </div>
        @endfor
        <button
          class="btn btn-primary nextBtn btn-lg mt-6 block"
          type="button"
          wire:click="secondStepSubmit"
        >
          Weiter
        </button>
        <button
          class="btn btn-primary nextBtn btn-lg mt-6 block"
          type="button"
          wire:click="back(1)"
        >
          Zurück
        </button>
      </div>
    </div>
  </div>

  <div
    class="row setup-content {{ $currentStep != 3 ? 'display-none' : '' }} my-7"
    id="step-3"
  >
    <div class="col-md-12">
      <div class="w-full flex flex-col content-end">
        <div class="flex flex-rows flex-auto flex-wrap pt-10">
          <img
            class="animate-spin animate-bounce animate-pulse w-1/3"
            src="{{ asset('/img/FX13_elf.png') }}"
          />
          <img
            class="animate-spin animate-bounce animate-pulse w-1/3"
            src="{{ asset('/img/FX13_elf.png') }}"
          />
          <img
            class="animate-spin animate-bounce animate-pulse w-1/3"
            src="{{ asset('/img/FX13_elf.png') }}"
          />
        </div>

        <button
          class="btn btn-secondary nextBtn btn-lg mt-6 block"
          wire:click="submitForm"
          type="button"
        >
          WICHTELN !
        </button>
        <button
          class="btn btn-primary nextBtn btn-lg mt-6 block"
          type="button"
          wire:click="back(2)"
        >
          Zurück
        </button>
      </div>
    </div>
  </div>
</div>
